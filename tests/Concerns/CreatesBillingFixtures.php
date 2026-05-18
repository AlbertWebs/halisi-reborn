<?php

namespace Tests\Concerns;

use App\Models\Billing\Client;
use App\Models\Billing\Invoice;
use App\Models\Billing\InvoiceToken;
use App\Models\Billing\Payment;

trait CreatesBillingFixtures
{
    protected function createBillingInvoice(array $overrides = []): Invoice
    {
        $client = Client::create([
            'name' => 'Test Client',
            'email' => 'client@example.com',
            'phone' => '+254700000000',
            'company' => 'Test Co',
            'address' => 'Nairobi',
            'city' => 'Nairobi',
            'country' => 'Kenya',
            'postal_code' => '00100',
        ]);

        return Invoice::create(array_merge([
            'client_id' => $client->id,
            'invoice_number' => 'INV-TEST-' . uniqid(),
            'issue_date' => now()->toDateString(),
            'due_date' => now()->addDays(14)->toDateString(),
            'subtotal' => 100,
            'tax_rate' => 0,
            'tax_amount' => 0,
            'discount_type' => 0,
            'discount_value' => 0,
            'discount_amount' => 0,
            'total' => 100,
            'currency' => 'USD',
            'status' => Invoice::STATUS_SENT,
        ], $overrides));
    }

    protected function createInvoiceToken(Invoice $invoice): InvoiceToken
    {
        return InvoiceToken::generateFor($invoice);
    }

    protected function createPendingPayment(Invoice $invoice, string $trackingId): Payment
    {
        return Payment::create([
            'invoice_id' => $invoice->id,
            'amount' => $invoice->total,
            'currency' => $invoice->currency,
            'payment_method' => 'pesapal',
            'transaction_id' => $trackingId,
            'status' => Payment::STATUS_PENDING,
        ]);
    }
}
