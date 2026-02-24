@extends('admin.layouts.admin')

@section('title', 'Billing Dashboard')
@section('page-title', 'Billing Dashboard')
@section('breadcrumb', 'Billing')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-sm font-medium text-gray-500">Total Invoices</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalInvoices }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-sm font-medium text-gray-500">Paid</p>
            <p class="text-2xl font-bold text-green-600 mt-1">{{ $paidInvoices }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-sm font-medium text-gray-500">Unpaid / Overdue</p>
            <p class="text-2xl font-bold text-amber-600 mt-1">{{ $unpaidInvoices }} @if($overdueCount)({{ $overdueCount }} overdue)@endif</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-sm font-medium text-gray-500">Revenue</p>
            <p class="text-2xl font-bold text-[var(--color-forest-green)] mt-1">USD {{ number_format($revenue, 2) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900">Recent Invoices</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Number</th>
                            <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                            <th class="px-6 py-2 text-right text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentInvoices as $inv)
                            <tr>
                                <td class="px-6 py-3 text-sm">
                                    <a href="{{ route('admin.billing.invoices.show', $inv) }}" class="text-[var(--color-forest-green)] hover:underline">{{ $inv->invoice_number }}</a>
                                </td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $inv->client->name }}</td>
                                <td class="px-6 py-3 text-sm text-right">{{ $inv->currency }} {{ number_format($inv->total, 2) }}</td>
                                <td class="px-6 py-3">
                                    <span class="px-2 py-0.5 text-xs rounded-full
                                        @if($inv->status === 'paid') bg-green-100 text-green-800
                                        @elseif($inv->status === 'overdue') bg-red-100 text-red-800
                                        @elseif($inv->status === 'sent') bg-amber-100 text-amber-800
                                        @else bg-gray-100 text-gray-800 @endif">{{ $inv->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-4 text-sm text-gray-500">No invoices yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 border-t border-gray-200">
                <a href="{{ route('admin.billing.invoices.index') }}" class="text-sm text-[var(--color-forest-green)] hover:underline">View all invoices →</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900">Recent Payments</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Invoice</th>
                            <th class="px-6 py-2 text-right text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentPayments as $pay)
                            <tr>
                                <td class="px-6 py-3 text-sm">{{ $pay->invoice->invoice_number }}</td>
                                <td class="px-6 py-3 text-sm text-right">{{ $pay->currency }} {{ number_format($pay->amount, 2) }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $pay->paid_at?->format('d M Y') ?? $pay->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-3"><span class="px-2 py-0.5 text-xs rounded-full {{ $pay->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">{{ $pay->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-4 text-sm text-gray-500">No payments yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 border-t border-gray-200">
                <a href="{{ route('admin.billing.payments.index') }}" class="text-sm text-[var(--color-forest-green)] hover:underline">View all payments →</a>
            </div>
        </div>
    </div>
@endsection
