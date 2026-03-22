@extends('admin.layouts.admin')

@section('title', 'Hero carousel slides')
@section('page-title', 'Hero carousel slides')

@section('content')
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <div>
            <p class="text-sm text-gray-600">Used when <strong>Site Settings</strong> hero type is <strong>carousel</strong>. If no active slides exist, the homepage uses video.</p>
        </div>
        <a href="{{ route('admin.hero-carousel.create') }}" class="inline-flex justify-center bg-[var(--color-forest-green)] text-white px-5 py-2 rounded-lg hover:bg-opacity-90 text-sm font-medium">
            Add slide
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-800 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preview</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Overlay</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($slides as $slide)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img src="{{ asset('storage/' . $slide->image) }}" alt="" class="w-28 h-16 object-cover rounded border border-gray-200">
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            <div class="font-medium">{{ $slide->overlay_title ?: '—' }}</div>
                            @if($slide->overlay_subtitle)
                                <div class="text-gray-500 text-xs mt-0.5">{{ \Illuminate\Support\Str::limit($slide->overlay_subtitle, 60) }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $slide->sort_order }}</td>
                        <td class="px-4 py-3">
                            @if($slide->is_active)
                                <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="text-xs font-semibold px-2 py-1 rounded-full bg-gray-100 text-gray-700">Off</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right text-sm space-x-2 whitespace-nowrap">
                            <a href="{{ route('admin.hero-carousel.edit', $slide) }}" class="text-[var(--color-forest-green)] font-medium hover:underline">Edit</a>
                            <form action="{{ route('admin.hero-carousel.destroy', $slide) }}" method="POST" class="inline" onsubmit="return confirm('Delete this slide?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500 text-sm">No slides yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
