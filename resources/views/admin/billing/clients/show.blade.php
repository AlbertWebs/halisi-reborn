@extends('admin.layouts.admin')

@section('title', 'Client: ' . $client->name)
@section('page-title', $client->name)
@section('breadcrumb', 'Billing / Clients')

@section('content')
    <div class="mb-6 flex gap-4">
        <a href="{{ route('admin.billing.clients.edit', $client) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium">Edit Client</a>
        <a href="{{ route('admin.billing.invoices.create') }}?client_id={{ $client->id }}" class="px-4 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 text-sm font-medium">New Invoice</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Contact</h3>
            <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $client->email }}</p>
            @if($client->phone)<p class="text-sm text-gray-600 mt-1"><strong>Phone:</strong> {{ $client->phone }}</p>@endif
            @if($client->company)<p class="text-sm text-gray-600 mt-1"><strong>Company:</strong> {{ $client->company }}</p>@endif
            @if($client->address)<p class="text-sm text-gray-600 mt-1"><strong>Address:</strong> {{ $client->address }}@if($client->city), {{ $client->city }}@endif @if($client->country) {{ $client->country }}@endif @if($client->postal_code) {{ $client->postal_code }}@endif</p>@endif
            @if($client->notes)<p class="text-sm text-gray-600 mt-3">{{ $client->notes }}</p>@endif
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900">Invoices ({{ $client->invoices->count() }})</h3>
            </div>
            <ul class="divide-y divide-gray-200">
                @forelse($client->invoices as $inv)
                    <li class="px-6 py-3 flex justify-between items-center">
                        <a href="{{ route('admin.billing.invoices.show', $inv) }}" class="text-[var(--color-forest-green)] hover:underline">{{ $inv->invoice_number }}</a>
                        <span class="text-sm text-gray-600">{{ $inv->currency }} {{ number_format($inv->total, 2) }}</span>
                        <span class="px-2 py-0.5 text-xs rounded-full
                            @if($inv->status === 'paid') bg-green-100 text-green-800
                            @elseif($inv->status === 'overdue') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">{{ $inv->status }}</span>
                    </li>
                @empty
                    <li class="px-6 py-4 text-sm text-gray-500">No invoices yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
