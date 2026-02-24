@extends('admin.layouts.admin')

@section('title', 'Billing Clients')
@section('page-title', 'Clients')
@section('breadcrumb', 'Billing / Clients')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row gap-4 justify-between">
        <form method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name, email, company..." class="rounded-lg border border-gray-300 px-4 py-2 text-sm w-64">
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm">Search</button>
        </form>
        <a href="{{ route('admin.billing.clients.create') }}" class="inline-flex items-center px-4 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 text-sm font-medium">Add Client</a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Invoices</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($clients as $client)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $client->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $client->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $client->company ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $client->invoices_count }}</td>
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <a href="{{ route('admin.billing.clients.show', $client) }}" class="text-[var(--color-forest-green)] hover:underline">View</a>
                            <a href="{{ route('admin.billing.clients.edit', $client) }}" class="text-gray-600 hover:underline">Edit</a>
                            @if($client->invoices_count === 0)
                                <form action="{{ route('admin.billing.clients.destroy', $client) }}" method="POST" class="inline" onsubmit="return confirm('Delete this client?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No clients yet. <a href="{{ route('admin.billing.clients.create') }}" class="text-[var(--color-forest-green)] hover:underline">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($clients->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">{{ $clients->links() }}</div>
        @endif
    </div>
@endsection
