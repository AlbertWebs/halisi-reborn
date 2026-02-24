@extends('admin.layouts.admin')

@section('title', 'Edit Itinerary Day')
@section('page-title', 'Edit Itinerary Day')
@section('breadcrumb', 'Journeys / ' . $journey->title . ' / Itinerary')

@section('content')
    <form method="POST" action="{{ route('admin.journeys.itinerary.update', [$journey, $itinerary]) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
            <p class="text-sm text-gray-500">Journey: <strong>{{ $journey->title }}</strong></p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="day" class="block text-sm font-medium text-gray-700 mb-2">Day number *</label>
                    <input type="number" id="day" name="day" min="1" value="{{ old('day', $itinerary->day) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $itinerary->title) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>
            </div>
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea id="content" name="content" rows="6"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('content', $itinerary->content) }}</textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.journeys.edit', $journey) }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                Update itinerary day
            </button>
        </div>
    </form>
@endsection
