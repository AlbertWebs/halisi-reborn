<?php

namespace App\Services\Billing;

use App\Models\Billing\Invoice;
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
        $this->consumerKey = config('pesapal.consumer_key', '');
        $this->consumerSecret = config('pesapal.consumer_secret', '');
    }

    /**
     * Register IPN URL and get notification_id (call once or when URL changes).
     */
    public function registerIpn(string $url): ?string
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($this->baseUrl . '/api/URLSetup/RegisterIPN', [
            'url' => $url,
            'ipn_notification_type' => 'GET',
        ]);

        if (!$response->successful()) {
            Log::warning('Pesapal register IPN failed', ['response' => $response->body()]);
            return null;
        }

        $data = $response->json();
        return $data['ipn_id'] ?? null;
    }

    /**
     * Submit order and get redirect URL for client to complete payment.
     */
    public function submitOrderRequest(Invoice $invoice, string $callbackUrl, string $id): array
    {
        $amount = (float) $invoice->total;
        $currency = $invoice->currency ?: 'USD';

        $payload = [
            'id' => $id,
            'currency' => $currency,
            'amount' => $amount,
            'description' => 'Invoice ' . $invoice->invoice_number,
            'callback_url' => $callbackUrl,
            'notification_id' => config('pesapal.ipn_id'),
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

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($this->baseUrl . '/api/Transactions/SubmitOrderRequest', $payload);

        if (!$response->successful()) {
            Log::warning('Pesapal SubmitOrderRequest failed', [
                'invoice_id' => $invoice->id,
                'response' => $response->body(),
            ]);
            return ['success' => false, 'redirect_url' => null, 'order_tracking_id' => null];
        }

        $data = $response->json();
        $redirectUrl = $data['redirect_url'] ?? null;
        $orderTrackingId = $data['order_tracking_id'] ?? null;

        return [
            'success' => !empty($redirectUrl),
            'redirect_url' => $redirectUrl,
            'order_tracking_id' => $orderTrackingId,
        ];
    }

    /**
     * Get transaction status by order tracking id.
     */
    public function getTransactionStatus(string $orderTrackingId): ?string
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->get($this->baseUrl . '/api/Transactions/GetTransactionStatus', [
            'orderTrackingId' => $orderTrackingId,
        ]);

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();
        return $data['payment_status_description'] ?? $data['payment_status'] ?? null;
    }
}
