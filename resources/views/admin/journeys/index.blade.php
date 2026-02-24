@extends('admin.layouts.admin')

@section('title', 'Journeys')
@section('page-title', 'Journeys')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">All Journeys</h3>
            <p class="text-sm text-gray-600">Manage your journey content</p>
        </div>
        <a href="{{ route('admin.journeys.create') }}" class="bg-[var(--color-forest-green)] text-white px-6 py-2 rounded-lg hover:bg-opacity-90 transition-colors font-medium">
            Add New Journey
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Countries</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($journeys as $journey)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $journey->title }}</div>
                            <div class="text-sm text-gray-500">{{ $journey->slug }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-gray-900">{{ $journey->category?->name ?? $journey->journey_category }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($journey->countries->count() > 0)
                                    {{ $journey->countries->pluck('name')->join(', ') }}
                                @else
                                    <span class="text-gray-400">No countries</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($journey->is_published)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Published</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.journeys.edit', $journey) }}" class="text-[var(--color-forest-green)] hover:text-opacity-80 mr-4">Edit</a>
                            <form action="{{ route('admin.journeys.destroy', $journey) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this journey?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No journeys found. <a href="{{ route('admin.journeys.create') }}" class="text-[var(--color-forest-green)] hover:underline">Create one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($journeys->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $journeys->links() }}
            </div>
        @endif
    </div>
@endsection
