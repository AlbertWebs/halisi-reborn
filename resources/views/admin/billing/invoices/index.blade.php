@extends('admin.layouts.admin')

@section('title', 'Invoices')
@section('page-title', 'Invoices')
@section('breadcrumb', 'Billing / Invoices')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row gap-4 justify-between">
        <form method="GET" class="flex flex-wrap gap-2 items-center">
            <select name="status" class="rounded-lg border border-gray-300 px-4 py-2 text-sm">
                <option value="">All statuses</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Sent</option>
                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="overdue" {{ request('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm">Filter</button>
        </form>
        <a href="{{ route('admin.billing.invoices.create') }}" class="inline-flex items-center px-4 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 text-sm font-medium">New Invoice</a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($invoices as $inv)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium">
                            <a href="{{ route('admin.billing.invoices.show', $inv) }}" class="text-[var(--color-forest-green)] hover:underline">{{ $inv->invoice_number }}</a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $inv->client->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $inv->due_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-right">{{ $inv->currency }} {{ number_format($inv->total, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-0.5 text-xs rounded-full
                                @if($inv->status === 'paid') bg-green-100 text-green-800
                                @elseif($inv->status === 'overdue') bg-red-100 text-red-800
                                @elseif($inv->status === 'sent') bg-amber-100 text-amber-800
                                @else bg-gray-100 text-gray-800 @endif">{{ $inv->status }}</span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <a href="{{ route('admin.billing.invoices.show', $inv) }}" class="text-[var(--color-forest-green)] hover:underline">View</a>
                            <a href="{{ route('admin.billing.invoices.pdf', $inv) }}" class="text-gray-600 hover:underline" target="_blank">PDF</a>
                            @if($inv->status === 'draft')
                                <a href="{{ route('admin.billing.invoices.edit', $inv) }}" class="text-gray-600 hover:underline">Edit</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">No invoices yet. <a href="{{ route('admin.billing.invoices.create') }}" class="text-[var(--color-forest-green)] hover:underline">Create one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($invoices->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">{{ $invoices->links() }}</div>
        @endif
    </div>
@endsection
