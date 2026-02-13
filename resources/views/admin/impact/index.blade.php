@extends('admin.layouts.admin')

@section('title', 'Impact Stats')
@section('page-title', 'Impact Statistics')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">All Impact Statistics</h3>
            <p class="text-sm text-gray-600">Manage your impact statistics</p>
        </div>
        <a href="{{ route('admin.impact.create') }}" class="bg-[var(--color-forest-green)] text-white px-6 py-2 rounded-lg hover:bg-opacity-90 transition-colors font-medium">
            Add New Stat
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stat Key</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Label</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($stats as $stat)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $stat->stat_key }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $stat->label }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">{{ number_format($stat->value) }}{{ $stat->suffix }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($stat->is_active)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.impact.edit', $stat) }}" class="text-[var(--color-forest-green)] hover:text-opacity-80 mr-4">Edit</a>
                            <form action="{{ route('admin.impact.destroy', $stat) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this stat?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No stats found. <a href="{{ route('admin.impact.create') }}" class="text-[var(--color-forest-green)] hover:underline">Create one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
