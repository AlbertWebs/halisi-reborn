<?php

namespace App\Services\Billing;

use App\Models\Billing\Invoice;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PesapalService
{
    protected string $baseUrl;
    protected string $consumerKey;
    protected string $consumerSecret;

    public function __construct()
    {
        $env = config('pesapal.environment', 'sandbox');
        $this->baseUrl = $env === 'live'
            ? 'https://pay.pesapal.com/v3'
            : 'https://cybqa.pesapal.com/pesapalv3';
        $this->consumerKey = (string) config('pesapal.consumer_key', '');
        $this->consumerSecret = (string) config('pesapal.consumer_secret', '');
    }

    /**
     * Obtain a Bearer token for API 3.0 (cached until shortly before expiry).
     */
    protected function getAccessToken(): ?string
    {
        if ($this->consumerKey === '' || $this->consumerSecret === '') {
            Log::warning('Pesapal credentials are not configured');
            return null;
        }

        $cacheKey = 'pesapal_access_token_' . md5($this->consumerKey . '|' . $this->baseUrl);

        $cached = Cache::get($cacheKey);
        if (filled($cached)) {
            return $cached;
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($this->baseUrl . '/api/Auth/RequestToken', [
            'consumer_key' => $this->consumerKey,
            'consumer_secret' => $this->consumerSecret,
        ]);

        if (!$response->successful()) {
            Log::warning('Pesapal RequestToken failed', ['response' => $response->body()]);
            return null;
        }

        $token = $response->json('token');
        if (!filled($token)) {
            Log::warning('Pesapal RequestToken returned no token', ['response' => $response->json()]);
            return null;
        }

        Cache::put($cacheKey, $token, now()->addMinutes(4));

        return $token;
    }

    protected function authenticatedRequest()
    {
        $token = $this->getAccessToken();
        if (!$token) {
            return Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
        }

        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);
    }

    /**
     * Resolve notification_id: .env value, cached registration, existing IPN list, or register new URL.
     */
    public function resolveNotificationId(): ?string
    {
        $configured = trim((string) config('pesapal.ipn_id', ''));
        if ($configured !== '') {
            return $configured;
        }

        $ipnUrl = trim((string) config('pesapal.ipn_url', ''));
        if ($ipnUrl === '') {
            Log::warning('Pesapal IPN URL is not configured');
            return null;
        }

        $cacheKey = 'pesapal_notification_id_' . md5($this->baseUrl . '|' . $ipnUrl);
        $cached = Cache::get($cacheKey);
        if (filled($cached)) {
            return $cached;
        }

        if (!$this->getAccessToken()) {
            return null;
        }

        $existing = $this->findRegisteredIpnId($ipnUrl);
        if (filled($existing)) {
            Cache::put($cacheKey, $existing, now()->addDays(30));
            return $existing;
        }

        $registered = $this->registerIpn($ipnUrl);
        if (filled($registered)) {
            Cache::put($cacheKey, $registered, now()->addDays(30));
            Log::info('Pesapal IPN registered automatically', [
                'ipn_id' => $registered,
                'url' => $ipnUrl,
            ]);
        }

        return $registered;
    }

    /**
     * Register IPN URL and get notification_id (call once or when URL changes).
     */
    public function registerIpn(string $url): ?string
    {
        if (!$this->getAccessToken()) {
            return null;
        }

        $response = $this->authenticatedRequest()->post($this->baseUrl . '/api/URLSetup/RegisterIPN', [
            'url' => $url,
            'ipn_notification_type' => 'GET',
        ]);

        if (!$response->successful()) {
            Log::warning('Pesapal register IPN failed', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);
            return null;
        }

        $data = $response->json();
        return $data['ipn_id'] ?? null;
    }

    protected function findRegisteredIpnId(string $ipnUrl): ?string
    {
        $response = $this->authenticatedRequest()->get($this->baseUrl . '/api/URLSetup/GetIpnList');

        if (!$response->successful()) {
            Log::warning('Pesapal GetIpnList failed', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);
            return null;
        }

        $list = $response->json();
        if (! is_array($list)) {
            return null;
        }

        foreach ($list as $item) {
            if (! is_array($item)) {
                continue;
            }
            $url = $item['url'] ?? null;
            if ($url && $this->ipnUrlsMatch((string) $url, $ipnUrl)) {
                return $item['ipn_id'] ?? null;
            }
        }

        return null;
    }

    protected function ipnUrlsMatch(string $registered, string $expected): bool
    {
        return rtrim(strtolower($registered), '/') === rtrim(strtolower($expected), '/');
    }

    /**
     * Submit order and get redirect URL for client to complete payment.
     */
    public function submitOrderRequest(Invoice $invoice, string $callbackUrl, string $id): array
    {
        if (!$this->getAccessToken()) {
            return [
                'success' => false,
                'redirect_url' => null,
                'order_tracking_id' => null,
                'error' => 'authentication_failed',
            ];
        }

        $notificationId = $this->resolveNotificationId();
        if (! filled($notificationId)) {
            Log::warning('Pesapal notification_id missing', [
                'ipn_url' => config('pesapal.ipn_url'),
                'hint' => 'Set PESAPAL_IPN_ID in .env or run: php artisan pesapal:register-ipn',
            ]);

            return [
                'success' => false,
                'redirect_url' => null,
                'order_tracking_id' => null,
                'error' => 'missing_notification_id',
            ];
        }

        $amount = (float) $invoice->total;
        $currency = config('pesapal.currency', 'KES');

        if (filled($invoice->currency) && strtoupper($invoice->currency) !== strtoupper($currency)) {
            Log::warning('Pesapal payment uses configured currency, not invoice currency', [
                'invoice_id' => $invoice->id,
                'invoice_currency' => $invoice->currency,
                'pesapal_currency' => $currency,
            ]);
        }
        $description = 'Invoice ' . $invoice->invoice_number;

        $redirectMode = config('pesapal.embed_in_iframe', true)
            ? config('pesapal.redirect_mode', 'PARENT_WINDOW')
            : 'TOP_WINDOW';

        $payload = [
            'id' => $this->sanitizeMerchantReference($id),
            'currency' => $currency,
            'amount' => $amount,
            'description' => mb_substr($description, 0, 100),
            'callback_url' => $callbackUrl,
            'redirect_mode' => $redirectMode,
            'notification_id' => $notificationId,
            'billing_address' => [
                'email_address' => $invoice->client->email,
                'phone_number' => $invoice->client->phone ?? '',
                'country_code' => 'KE',
                'first_name' => $invoice->client->name,
                'middle_name' => '',
                'last_name' => '',
                'line_1' => $invoice->client->address ?? '',
                'line_2' => '',
                'city' => $invoice->client->city ?? '',
                'state' => '',
                'postal_code' => $invoice->client->postal_code ?? '',
                'zip_code' => $invoice->client->postal_code ?? '',
            ],
        ];

        $response = $this->authenticatedRequest()->post($this->baseUrl . '/api/Transactions/SubmitOrderRequest', $payload);

        if (!$response->successful()) {
            $body = $response->json() ?? [];
            Log::warning('Pesapal SubmitOrderRequest failed', [
                'invoice_id' => $invoice->id,
                'status' => $response->status(),
                'response' => $response->body(),
                'message' => $body['message'] ?? $body['error'] ?? null,
            ]);

            return [
                'success' => false,
                'redirect_url' => null,
                'order_tracking_id' => null,
                'error' => $body['message'] ?? 'submit_order_failed',
            ];
        }

        $data = $response->json();
        $redirectUrl = $data['redirect_url'] ?? null;
        $orderTrackingId = $data['order_tracking_id'] ?? null;

        if (empty($redirectUrl)) {
            Log::warning('Pesapal SubmitOrderRequest missing redirect_url', [
                'invoice_id' => $invoice->id,
                'response' => $data,
            ]);
        }

        return [
            'success' => ! empty($redirectUrl),
            'redirect_url' => $redirectUrl,
            'order_tracking_id' => $orderTrackingId,
            'error' => empty($redirectUrl) ? ($data['message'] ?? 'missing_redirect_url') : null,
        ];
    }

    /**
     * Pesapal allows alphanumeric, dash, underscore, dot, colon; max 50 chars.
     */
    protected function sanitizeMerchantReference(string $id): string
    {
        $sanitized = preg_replace('/[^A-Za-z0-9._:-]/', '-', $id) ?? $id;

        return mb_substr($sanitized, 0, 50);
    }

    /**
     * Get transaction status by order tracking id.
     */
    public function getTransactionStatus(string $orderTrackingId): ?string
    {
        if (!$this->getAccessToken()) {
            return null;
        }

        $response = $this->authenticatedRequest()->get($this->baseUrl . '/api/Transactions/GetTransactionStatus', [
            'orderTrackingId' => $orderTrackingId,
        ]);

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();
        return $data['payment_status_description'] ?? $data['payment_status'] ?? null;
    }
}
