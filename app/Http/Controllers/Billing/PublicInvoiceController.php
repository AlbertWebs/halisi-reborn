<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Billing\Invoice;
use App\Models\Billing\InvoiceToken;
use App\Models\Billing\Payment;
use App\Services\Billing\InvoicePdfService;
use App\Services\Billing\PesapalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublicInvoiceController extends Controller
{
    public function show(string $token)
    {
        $invoiceToken = InvoiceToken::where('token', $token)->with('invoice.client')->firstOrFail();

        if (!$invoiceToken->isValid()) {
            abort(410, 'This payment link has expired.');
        }

        $invoice = $invoiceToken->invoice;
        if ($invoice->status === Invoice::STATUS_PAID && $invoice->isFullyPaid()) {
            return view('billing.public.invoice', compact('invoice', 'invoiceToken'))->with('alreadyPaid', true);
        }

        return view('billing.public.invoice', compact('invoice', 'invoiceToken'));
    }

    public function pay(Request $request, string $token)
    {
        $invoiceToken = InvoiceToken::where('token', $token)->with('invoice.client')->firstOrFail();

        if (!$invoiceToken->isValid()) {
            return redirect()->route('billing.invoice.show', $token)->with('error', 'This payment link has expired.');
        }

        $invoice = $invoiceToken->invoice;

        if ($invoice->status === Invoice::STATUS_PAID && $invoice->isFullyPaid()) {
            return redirect()->route('billing.invoice.show', $token)->with('info', 'This invoice is already paid.');
        }

        $amountDue = (float) $invoice->total - $invoice->totalPaid();
        if ($amountDue <= 0) {
            $invoice->update(['status' => Invoice::STATUS_PAID]);
            return redirect()->route('billing.invoice.show', $token)->with('success', 'Invoice is already fully paid.');
        }

        $callbackUrl = route('billing.callback', ['token' => $token]);
        $pesapal = new PesapalService();
        $orderId = 'INV-' . $invoice->id . '-' . time();
        $result = $pesapal->submitOrderRequest($invoice, $callbackUrl, $orderId);

        if (!$result['success'] || empty($result['redirect_url'])) {
            Log::warning('Pesapal redirect URL missing', ['invoice_id' => $invoice->id, 'result' => $result]);
            return redirect()->route('billing.invoice.show', $token)->with('error', 'Unable to initiate payment. Please try again or contact support.');
        }

        $payment = Payment::create([
            'invoice_id' => $invoice->id,
            'amount' => $amountDue,
            'currency' => $invoice->currency,
            'payment_method' => 'pesapal',
            'transaction_id' => $result['order_tracking_id'] ?? $orderId,
            'status' => Payment::STATUS_PENDING,
            'gateway_response' => json_encode(['redirect_url' => $result['redirect_url'], 'order_tracking_id' => $result['order_tracking_id'] ?? null]),
        ]);

        session(['pesapal_order_tracking_id' => $result['order_tracking_id'], 'pesapal_invoice_token' => $token]);

        return redirect()->away($result['redirect_url']);
    }

    public function callback(Request $request, string $token)
    {
        $invoiceToken = InvoiceToken::where('token', $token)->with('invoice')->firstOrFail();
        $invoice = $invoiceToken->invoice;

        $orderTrackingId = $request->query('OrderTrackingId') ?? session('pesapal_order_tracking_id');

        if (!$orderTrackingId) {
            return redirect()->route('billing.invoice.show', $token)->with('error', 'Invalid callback.');
        }

        $pesapal = new PesapalService();
        $status = $pesapal->getTransactionStatus($orderTrackingId);

        $payment = Payment::where('invoice_id', $invoice->id)
            ->where('transaction_id', $orderTrackingId)
            ->first();

        if (!$payment) {
            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => $invoice->total,
                'currency' => $invoice->currency,
                'payment_method' => 'pesapal',
                'transaction_id' => $orderTrackingId,
                'status' => Payment::STATUS_PENDING,
                'gateway_response' => $status,
            ]);
        }

        $completed = in_array(strtolower($status ?? ''), ['completed', 'paid', 'success'], true);

        if ($completed) {
            if ($payment->status !== Payment::STATUS_COMPLETED) {
                $payment->update(['status' => Payment::STATUS_COMPLETED, 'paid_at' => now(), 'gateway_response' => $status]);
            }
            if ($invoice->isFullyPaid()) {
                $invoice->update(['status' => Invoice::STATUS_PAID]);
            }
            return redirect()->route('billing.invoice.show', $token)->with('success', 'Payment received. Thank you!');
        }

        return redirect()->route('billing.invoice.show', $token)->with('info', 'Payment is being processed. You will be notified when it is confirmed.');
    }

    public function ipn(Request $request)
    {
        Log::info('Pesapal IPN received', $request->all());

        $orderTrackingId = $request->query('OrderTrackingId');
        if (!$orderTrackingId) {
            return response()->json(['message' => 'Missing OrderTrackingId'], 400);
        }

        $pesapal = new PesapalService();
        $status = $pesapal->getTransactionStatus($orderTrackingId);

        $payment = Payment::where('transaction_id', $orderTrackingId)->first();
        if ($payment && in_array(strtolower($status ?? ''), ['completed', 'paid', 'success'], true)) {
            if ($payment->status !== Payment::STATUS_COMPLETED) {
                $payment->update(['status' => Payment::STATUS_COMPLETED, 'paid_at' => now(), 'gateway_response' => $status]);
                $invoice = $payment->invoice;
                if ($invoice->isFullyPaid()) {
                    $invoice->update(['status' => Invoice::STATUS_PAID]);
                }
            }
        }

        return response()->json(['message' => 'OK']);
    }

    public function downloadPdf(string $token, InvoicePdfService $pdfService)
    {
        $invoiceToken = InvoiceToken::where('token', $token)->with('invoice')->firstOrFail();
        if (!$invoiceToken->isValid()) {
            abort(410, 'This link has expired.');
        }
        return $pdfService->download($invoiceToken->invoice);
    }
}
