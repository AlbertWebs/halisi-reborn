<?php

namespace Tests\Unit;

use App\Models\Billing\Invoice;
use App\Services\Billing\PesapalService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\Concerns\CreatesBillingFixtures;
use Tests\TestCase;

class PesapalServiceTest extends TestCase
{
    use CreatesBillingFixtures;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'pesapal.environment' => 'live',
            'pesapal.consumer_key' => 'test-consumer-key',
            'pesapal.consumer_secret' => 'test-consumer-secret',
            'pesapal.ipn_id' => 'test-ipn-id',
        ]);

        Cache::flush();
    }

    public function test_it_uses_live_base_url_when_environment_is_live(): void
    {
        config(['pesapal.environment' => 'live']);

        Http::fake([
            'https://pay.pesapal.com/v3/api/Auth/RequestToken' => Http::response(['token' => 'live-token'], 200),
            'https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus*' => Http::response([
                'payment_status_description' => 'Completed',
            ], 200),
        ]);

        $service = new PesapalService();
        $status = $service->getTransactionStatus('order-123');

        $this->assertSame('Completed', $status);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://pay.pesapal.com/v3/api/Auth/RequestToken'
                && $request['consumer_key'] === 'test-consumer-key'
                && $request['consumer_secret'] === 'test-consumer-secret';
        });

        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus')
                && $request->hasHeader('Authorization', 'Bearer live-token');
        });
    }

    public function test_it_uses_sandbox_base_url_when_environment_is_sandbox(): void
    {
        config(['pesapal.environment' => 'sandbox']);

        Http::fake([
            'https://cybqa.pesapal.com/pesapalv3/api/Auth/RequestToken' => Http::response(['token' => 'sandbox-token'], 200),
            'https://cybqa.pesapal.com/pesapalv3/api/Transactions/GetTransactionStatus*' => Http::response([
                'payment_status' => 'Pending',
            ], 200),
        ]);

        $service = new PesapalService();
        $status = $service->getTransactionStatus('order-456');

        $this->assertSame('Pending', $status);
    }

    public function test_submit_order_request_returns_redirect_url_on_success(): void
    {
        Http::fake([
            'https://pay.pesapal.com/v3/api/Auth/RequestToken' => Http::response(['token' => 'token-abc'], 200),
            'https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest' => Http::response([
                'redirect_url' => 'https://pay.pesapal.com/checkout/abc',
                'order_tracking_id' => 'track-789',
            ], 200),
        ]);

        $invoice = $this->createBillingInvoice();
        $invoice->load('client');

        $service = new PesapalService();
        $result = $service->submitOrderRequest($invoice, 'https://example.com/callback', 'INV-1');

        $this->assertTrue($result['success']);
        $this->assertSame('https://pay.pesapal.com/checkout/abc', $result['redirect_url']);
        $this->assertSame('track-789', $result['order_tracking_id']);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest'
                && $request['notification_id'] === 'test-ipn-id'
                && $request['amount'] === 100.0
                && $request['currency'] === 'USD';
        });
    }

    public function test_submit_order_request_fails_when_auth_fails(): void
    {
        Http::fake([
            'https://pay.pesapal.com/v3/api/Auth/RequestToken' => Http::response(['error' => 'invalid'], 401),
        ]);

        $invoice = $this->createBillingInvoice();
        $invoice->load('client');

        $service = new PesapalService();
        $result = $service->submitOrderRequest($invoice, 'https://example.com/callback', 'INV-2');

        $this->assertFalse($result['success']);
        $this->assertNull($result['redirect_url']);
    }

    public function test_register_ipn_returns_ipn_id(): void
    {
        Http::fake([
            'https://pay.pesapal.com/v3/api/Auth/RequestToken' => Http::response(['token' => 'token-abc'], 200),
            'https://pay.pesapal.com/v3/api/URLSetup/RegisterIPN' => Http::response(['ipn_id' => 'registered-ipn-id'], 200),
        ]);

        $service = new PesapalService();
        $ipnId = $service->registerIpn('https://example.com/billing/ipn');

        $this->assertSame('registered-ipn-id', $ipnId);
    }

    public function test_resolve_notification_id_registers_when_env_empty(): void
    {
        config(['pesapal.ipn_id' => '']);
        config(['pesapal.ipn_url' => 'http://localhost/billing/ipn']);

        Http::fake([
            'https://pay.pesapal.com/v3/api/Auth/RequestToken' => Http::response(['token' => 'token-abc'], 200),
            'https://pay.pesapal.com/v3/api/URLSetup/GetIpnList' => Http::response([], 200),
            'https://pay.pesapal.com/v3/api/URLSetup/RegisterIPN' => Http::response(['ipn_id' => 'auto-registered-guid'], 200),
        ]);

        $service = new PesapalService();
        $ipnId = $service->resolveNotificationId();

        $this->assertSame('auto-registered-guid', $ipnId);
    }

    public function test_resolve_notification_id_reuses_existing_ipn_from_list(): void
    {
        config(['pesapal.ipn_id' => '']);
        config(['pesapal.ipn_url' => 'http://localhost/billing/ipn']);

        Http::fake([
            'https://pay.pesapal.com/v3/api/Auth/RequestToken' => Http::response(['token' => 'token-abc'], 200),
            'https://pay.pesapal.com/v3/api/URLSetup/GetIpnList' => Http::response([
                [
                    'url' => 'http://localhost/billing/ipn',
                    'ipn_id' => 'existing-guid',
                ],
            ], 200),
        ]);

        $service = new PesapalService();
        $ipnId = $service->resolveNotificationId();

        $this->assertSame('existing-guid', $ipnId);
        Http::assertNotSent(fn ($request) => str_contains($request->url(), 'RegisterIPN'));
    }
}
