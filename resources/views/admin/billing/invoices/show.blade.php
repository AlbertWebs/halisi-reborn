@extends('admin.layouts.admin')

@section('title', 'Invoice ' . $invoice->invoice_number)
@section('page-title', 'Invoice ' . $invoice->invoice_number)
@section('breadcrumb', 'Billing / Invoices')

@section('content')
    @if(session('payment_link_url'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-sm font-medium text-green-800">Payment link (copy and share with client):</p>
            <p class="mt-1 text-sm text-green-700 break-all">{{ session('payment_link_url') }}</p>
        </div>
    @endif

    <div class="mb-6 flex flex-wrap gap-3">
        <a href="{{ route('admin.billing.invoices.pdf', $invoice) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium">Download PDF</a>
        @if($invoice->status === 'draft')
            <a href="{{ route('admin.billing.invoices.edit', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium">Edit</a>
            <form action="{{ route('admin.billing.invoices.mark-sent', $invoice) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-amber-100 text-amber-800 rounded-lg hover:bg-amber-200 text-sm font-medium">Mark as Sent</button>
            </form>
        @endif
        <form action="{{ route('admin.billing.invoices.payment-link', $invoice) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 text-sm font-medium">Get Payment Link</button>
        </form>
        <form action="{{ route('admin.billing.invoices.duplicate', $invoice) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium">Duplicate</button>
        </form>
        @if($invoice->status === 'draft' && !$invoice->payments()->where('status', 'completed')->exists())
            <form action="{{ route('admin.billing.invoices.destroy', $invoice) }}" method="POST" class="inline" onsubmit="return confirm('Delete this invoice?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-sm font-medium">Delete</button>
            </form>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Client</p>
            <p class="font-medium text-gray-900">{{ $invoice->client->name }}</p>
            <p class="text-sm text-gray-600">{{ $invoice->client->email }}</p>
            @if($invoice->client->phone)<p class="text-sm text-gray-600">{{ $invoice->client->phone }}</p>@endif
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Dates</p>
            <p class="text-sm text-gray-700">Issue: {{ $invoice->issue_date->format('d M Y') }} · Due: {{ $invoice->due_date->format('d M Y') }}</p>
            <p class="mt-2"><span class="px-2 py-0.5 text-xs rounded-full
                @if($invoice->status === 'paid') bg-green-100 text-green-800
                @elseif($invoice->status === 'overdue') bg-red-100 text-red-800
                @elseif($invoice->status === 'sent') bg-amber-100 text-amber-800
                @else bg-gray-100 text-gray-800 @endif">{{ $invoice->status }}</span></p>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Qty</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($invoice->items as $item)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-900">{{ $item->description }} @if($item->unit)<span class="text-gray-500">({{ $item->unit }})</span>@endif</td>
                        <td class="px-6 py-3 text-sm text-right">{{ number_format($item->quantity, 2) }}</td>
                        <td class="px-6 py-3 text-sm text-right">{{ $invoice->currency }} {{ number_format($item->unit_price, 2) }}</td>
                        <td class="px-6 py-3 text-sm text-right">{{ $invoice->currency }} {{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end">
            <table class="w-64 text-sm">
                <tr><td class="py-1 text-gray-600">Subtotal</td><td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->subtotal, 2) }}</td></tr>
                @if((float) $invoice->tax_amount > 0)
                    <tr><td class="py-1 text-gray-600">Tax</td><td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->tax_amount, 2) }}</td></tr>
                @endif
                @if((float) $invoice->discount_amount > 0)
                    <tr><td class="py-1 text-gray-600">Discount</td><td class="text-right">- {{ $invoice->currency }} {{ number_format($invoice->discount_amount, 2) }}</td></tr>
                @endif
                <tr class="font-bold text-gray-900"><td class="py-2">Total</td><td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->total, 2) }}</td></tr>
            </table>
        </div>
    </div>

    @if($invoice->payments->count() > 0)
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900">Payments</h3>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-2 text-right text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Method</th>
                        <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Transaction ID</th>
                        <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($invoice->payments as $pay)
                        <tr>
                            <td class="px-6 py-3 text-sm">{{ $pay->paid_at?->format('d M Y H:i') ?? $pay->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-3 text-sm text-right">{{ $pay->currency }} {{ number_format($pay->amount, 2) }}</td>
                            <td class="px-6 py-3 text-sm">{{ $pay->payment_method ?? '—' }}</td>
                            <td class="px-6 py-3 text-sm text-gray-600">{{ $pay->transaction_id ?? '—' }}</td>
                            <td class="px-6 py-3"><span class="px-2 py-0.5 text-xs rounded-full {{ $pay->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">{{ $pay->status }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
