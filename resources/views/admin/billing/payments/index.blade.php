@extends('admin.layouts.admin')

@section('title', 'Payments')
@section('page-title', 'Payments')
@section('breadcrumb', 'Billing / Payments')

@section('content')
    <div class="mb-6">
        <form method="GET" class="flex flex-wrap gap-2 items-center">
            <select name="status" class="rounded-lg border border-gray-300 px-4 py-2 text-sm">
                <option value="">All statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Invoice</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Method</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Transaction ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($payments as $pay)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $pay->paid_at?->format('d M Y H:i') ?? $pay->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('admin.billing.invoices.show', $pay->invoice) }}" class="text-[var(--color-forest-green)] hover:underline">{{ $pay->invoice->invoice_number }}</a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $pay->invoice->client->name }}</td>
                        <td class="px-6 py-4 text-sm text-right font-medium">{{ $pay->currency }} {{ number_format($pay->amount, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $pay->payment_method ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $pay->transaction_id ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ $pay->status === 'completed' ? 'bg-green-100 text-green-800' : ($pay->status === 'failed' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">{{ $pay->status }}</span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">No payments yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($payments->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">{{ $payments->links() }}</div>
        @endif
    </div>
@endsection
