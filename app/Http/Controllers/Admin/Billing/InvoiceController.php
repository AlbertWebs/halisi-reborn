<?php

namespace App\Http\Controllers\Admin\Billing;

use App\Http\Controllers\Controller;
use App\Models\Billing\Client;
use App\Models\Billing\Invoice;
use App\Models\Billing\InvoiceItem;
use App\Models\Billing\InvoiceToken;
use App\Services\Billing\InvoicePdfService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $this->updateOverdueStatus();
        $query = Invoice::with('client');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $invoices = $query->orderByDesc('created_at')->paginate(20)->withQueryString();
        return view('admin.billing.invoices.index', compact('invoices'));
    }

    public function create(Request $request)
    {
        $clients = Client::orderBy('name')->get();
        $preselectedClientId = $request->query('client_id');
        return view('admin.billing.invoices.create', compact('clients', 'preselectedClientId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:billing_clients,id',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'discount_type' => 'nullable|in:0,1',
            'discount_value' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|in:USD,KES',
            'notes' => 'nullable|string|max:2000',
            'payment_instructions' => 'nullable|string|max:2000',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string|max:500',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit' => 'nullable|string|max:50',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $invoice = new Invoice();
        $invoice->client_id = $validated['client_id'];
        $invoice->invoice_number = $this->generateInvoiceNumber();
        $invoice->issue_date = $validated['issue_date'];
        $invoice->due_date = $validated['due_date'];
        $invoice->tax_rate = $validated['tax_rate'] ?? 0;
        $invoice->discount_type = $validated['discount_type'] ?? 0;
        $invoice->discount_value = $validated['discount_value'] ?? 0;
        $invoice->currency = $validated['currency'] ?? 'USD';
        $invoice->notes = $validated['notes'] ?? null;
        $invoice->payment_instructions = $validated['payment_instructions'] ?? null;
        $invoice->status = Invoice::STATUS_DRAFT;
        $invoice->subtotal = $invoice->tax_amount = $invoice->discount_amount = $invoice->total = 0;
        $invoice->save();

        foreach ($validated['items'] as $i => $item) {
            $total = round((float) $item['quantity'] * (float) $item['unit_price'], 2);
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'] ?? null,
                'unit_price' => $item['unit_price'],
                'total' => $total,
                'sort_order' => $i,
            ]);
        }

        $invoice->load('items');
        $invoice->recalculateTotals();

        return redirect()->route('admin.billing.invoices.show', $invoice)->with('success', 'Invoice created successfully.');
    }

    public function show(\App\Models\Billing\Invoice $invoice)
    {
        $this->updateOverdueStatus();
        $invoice->load(['client', 'items', 'payments', 'tokens']);
        return view('admin.billing.invoices.show', compact('invoice'));
    }

    public function paymentLink(\App\Models\Billing\Invoice $invoice)
    {
        $token = $invoice->tokens()->where(function ($q) {
            $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
        })->first();

        if (!$token) {
            $token = InvoiceToken::generateFor($invoice, now()->addYear());
        }

        $url = route('billing.invoice.show', $token->token);
        return redirect()->route('admin.billing.invoices.show', $invoice)->with('success', 'Payment link: ' . $url)->with('payment_link_url', $url);
    }

    public function edit(\App\Models\Billing\Invoice $invoice)
    {
        if ($invoice->status !== Invoice::STATUS_DRAFT) {
            return redirect()->route('admin.billing.invoices.show', $invoice)->with('error', 'Only draft invoices can be edited.');
        }
        $invoice->load('items');
        $clients = Client::orderBy('name')->get();
        return view('admin.billing.invoices.edit', compact('invoice', 'clients'));
    }

    public function update(Request $request, \App\Models\Billing\Invoice $invoice)
    {
        if ($invoice->status !== Invoice::STATUS_DRAFT) {
            return redirect()->route('admin.billing.invoices.show', $invoice)->with('error', 'Only draft invoices can be edited.');
        }

        $validated = $request->validate([
            'client_id' => 'required|exists:billing_clients,id',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'discount_type' => 'nullable|in:0,1',
            'discount_value' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|in:USD,KES',
            'notes' => 'nullable|string|max:2000',
            'payment_instructions' => 'nullable|string|max:2000',
            'items' => 'required|array|min:1',
            'items.*.id' => 'nullable|exists:billing_invoice_items,id',
            'items.*.description' => 'required|string|max:500',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit' => 'nullable|string|max:50',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $invoice->client_id = $validated['client_id'];
        $invoice->issue_date = $validated['issue_date'];
        $invoice->due_date = $validated['due_date'];
        $invoice->tax_rate = $validated['tax_rate'] ?? 0;
        $invoice->discount_type = $validated['discount_type'] ?? 0;
        $invoice->discount_value = $validated['discount_value'] ?? 0;
        $invoice->currency = $validated['currency'] ?? 'USD';
        $invoice->notes = $validated['notes'] ?? null;
        $invoice->payment_instructions = $validated['payment_instructions'] ?? null;
        $invoice->save();

        $existingIds = [];
        foreach ($validated['items'] as $i => $itemData) {
            $total = round((float) $itemData['quantity'] * (float) $itemData['unit_price'], 2);
            if (!empty($itemData['id'])) {
                $item = InvoiceItem::where('invoice_id', $invoice->id)->find($itemData['id']);
                if ($item) {
                    $item->update([
                        'description' => $itemData['description'],
                        'quantity' => $itemData['quantity'],
                        'unit' => $itemData['unit'] ?? null,
                        'unit_price' => $itemData['unit_price'],
                        'total' => $total,
                        'sort_order' => $i,
                    ]);
                    $existingIds[] = $item->id;
                    continue;
                }
            }
            $newItem = InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $itemData['description'],
                'quantity' => $itemData['quantity'],
                'unit' => $itemData['unit'] ?? null,
                'unit_price' => $itemData['unit_price'],
                'total' => $total,
                'sort_order' => $i,
            ]);
            $existingIds[] = $newItem->id;
        }

        InvoiceItem::where('invoice_id', $invoice->id)->whereNotIn('id', $existingIds)->delete();

        $invoice->load('items');
        $invoice->recalculateTotals();

        return redirect()->route('admin.billing.invoices.show', $invoice)->with('success', 'Invoice updated successfully.');
    }

    public function destroy(\App\Models\Billing\Invoice $invoice)
    {
        if ($invoice->payments()->where('status', 'completed')->exists()) {
            return redirect()->route('admin.billing.invoices.index')->with('error', 'Cannot delete an invoice that has completed payments.');
        }
        $invoice->delete();
        return redirect()->route('admin.billing.invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    public function pdf(\App\Models\Billing\Invoice $invoice, InvoicePdfService $pdfService)
    {
        return $pdfService->download($invoice);
    }

    public function duplicate(\App\Models\Billing\Invoice $invoice)
    {
        $newInvoice = $invoice->replicate(['invoice_number']);
        $newInvoice->invoice_number = $this->generateInvoiceNumber();
        $newInvoice->status = Invoice::STATUS_DRAFT;
        $newInvoice->issue_date = now();
        $newInvoice->due_date = now()->addDays(30);
        $newInvoice->save();

        foreach ($invoice->items as $item) {
            $newInvoice->items()->create($item->only(['description', 'quantity', 'unit', 'unit_price', 'total', 'sort_order']));
        }
        $newInvoice->recalculateTotals();

        return redirect()->route('admin.billing.invoices.show', $newInvoice)->with('success', 'Invoice duplicated successfully.');
    }

    public function markSent(\App\Models\Billing\Invoice $invoice)
    {
        if ($invoice->status !== Invoice::STATUS_DRAFT) {
            return back()->with('error', 'Only draft invoices can be marked as sent.');
        }
        $invoice->update(['status' => Invoice::STATUS_SENT]);
        return back()->with('success', 'Invoice marked as sent.');
    }

    protected function updateOverdueStatus(): void
    {
        Invoice::where('status', Invoice::STATUS_SENT)->where('due_date', '<', now()->startOfDay())->update(['status' => Invoice::STATUS_OVERDUE]);
    }

    protected function generateInvoiceNumber(): string
    {
        $prefix = 'INV-' . date('Ymd');
        $last = Invoice::where('invoice_number', 'like', $prefix . '%')->orderByDesc('id')->first();
        $seq = $last ? (int) substr($last->invoice_number, -4) + 1 : 1;
        return $prefix . '-' . str_pad((string) $seq, 4, '0', STR_PAD_LEFT);
    }
}
