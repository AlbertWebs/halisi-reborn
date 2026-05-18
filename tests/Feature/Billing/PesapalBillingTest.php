<?php

namespace Tests\Feature\Billing;

use App\Models\Billing\Invoice;
use App\Models\Billing\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\Concerns\CreatesBillingFixtures;
use Tests\TestCase;

class PesapalBillingTest extends TestCase
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
            'pesapal.embed_in_iframe' => true,
            'app.url' => 'http://localhost',
        ]);
    }

    public function test_public_invoice_page_loads_with_valid_token(): void
    {
        $invoice = $this->createBillingInvoice();
        $token = $this->createInvoiceToken($invoice);

        $response = $this->get(route('billing.invoice.show', $token->token));

        $response->assertOk();
        $response->assertSee($invoice->invoice_number);
    }

    public function test_pay_embeds_pesapal_checkout_in_iframe_when_order_submission_succeeds(): void
    {
        Http::fake([
            'https://pay.pesapal.com/v3/api/Auth/RequestToken' => Http::response(['token' => 'token-abc'], 200),
            'https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest' => Http::response([
                'redirect_url' => 'https://pay.pesapal.com/checkout/xyz',
                'order_tracking_id' => 'pesapal-track-001',
            ], 200),
        ]);

        $invoice = $this->createBillingInvoice();
        $token = $this->createInvoiceToken($invoice);

        $response = $this->get(route('billing.invoice.pay', $token->token));

        $response->assertOk();
        $response->assertViewIs('billing.public.pay');
        $response->assertSee('https://pay.pesapal.com/checkout/xyz', false);
        $response->assertSee('pesapal-checkout-frame', false);

        $this->assertDatabaseHas('billing_payments', [
            'invoice_id' => $invoice->id,
            'transaction_id' => 'pesapal-track-001',
            'status' => Payment::STATUS_PENDING,
            'payment_method' => 'pesapal',
        ]);
    }

    public function test_pay_returns_error_when_pesapal_submission_fails(): void
    {
        Http::fake([
            'https://pay.pesapal.com/v3/api/Auth/RequestToken' => Http::response(['error' => 'unauthorized'], 401),
            'https://pay.pesapal.com/v3/*' => Http::response(['error' => 'should not be called'], 500),
        ]);

        $invoice = $this->createBillingInvoice();
        $token = $this->createInvoiceToken($invoice);

        $response = $this->get(route('billing.invoice.pay', $token->token));

        $response->assertRedirect(route('billing.invoice.show', $token->token));
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('billing_payments', 0);
    }

    public function test_callback_marks_invoice_paid_on_completed_status(): void
    {
        Http::fake([
            'https://pay.pesapal.com/v3/api/Auth/RequestToken' => Http::response(['token' => 'token-abc'], 200),
            'https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus*' => Http::response([
                'payment_status_description' => 'Completed',
            ], 200),
        ]);

        $invoice = $this->createBillingInvoice();
        $token = $this->createInvoiceToken($invoice);
        $this->createPendingPayment($invoice, 'pesapal-track-callback');

        $response = $this->get(route('billing.callback', [
            'token' => $token->token,
            'OrderTrackingId' => 'pesapal-track-callback',
        ]));

        $response->assertOk();
        $response->assertViewIs('billing.public.callback-redirect');
        $this->assertStringContainsString($token->token, $response->getContent());

        $invoice->refresh();
        $this->assertSame(Invoice::STATUS_PAID, $invoice->status);
        $this->assertDatabaseHas('billing_payments', [
            'transaction_id' => 'pesapal-track-callback',
            'status' => Payment::STATUS_COMPLETED,
        ]);
    }

    public function test_ipn_endpoint_updates_payment_and_invoice(): void
    {
        Http::fake([
            'https://pay.pesapal.com/v3/api/Auth/RequestToken' => Http::response(['token' => 'token-abc'], 200),
            'https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus*' => Http::response([
                'payment_status' => 'Completed',
            ], 200),
        ]);

        $invoice = $this->createBillingInvoice();
        $this->createPendingPayment($invoice, 'pesapal-track-ipn');

        $response = $this->get(route('billing.ipn', ['OrderTrackingId' => 'pesapal-track-ipn']));

        $response->assertOk();
        $response->assertJson(['message' => 'OK']);

        $invoice->refresh();
        $this->assertSame(Invoice::STATUS_PAID, $invoice->status);
    }

    public function test_ipn_returns_400_without_order_tracking_id(): void
    {
        $response = $this->get(route('billing.ipn'));

        $response->assertStatus(400);
        $response->assertJson(['message' => 'Missing OrderTrackingId']);
    }

    public function test_pesapal_config_aligns_with_env_keys(): void
    {
        $this->assertSame('live', config('pesapal.environment'));
        $this->assertSame('test-consumer-key', config('pesapal.consumer_key'));
        $this->assertSame('test-consumer-secret', config('pesapal.consumer_secret'));
        $this->assertSame('test-ipn-id', config('pesapal.ipn_id'));
        $this->assertStringContainsString('/billing/callback', config('pesapal.callback_url'));
        $this->assertStringContainsString('/billing/ipn', config('pesapal.ipn_url'));
    }
}
