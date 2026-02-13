@extends('admin.layouts.admin')

@section('title', 'Create Impact Stat')
@section('page-title', 'Create Impact Stat')
@section('breadcrumb', 'Impact / Create')

@section('content')
    <form method="POST" action="{{ route('admin.impact.store') }}" class="space-y-6">
        @csrf

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="stat_key" class="block text-sm font-medium text-gray-700 mb-2">Stat Key *</label>
                    <input type="text" id="stat_key" name="stat_key" value="{{ old('stat_key') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    <p class="text-xs text-gray-500 mt-1">Unique identifier (e.g., mangroves_planted)</p>
                </div>

                <div>
                    <label for="label" class="block text-sm font-medium text-gray-700 mb-2">Label *</label>
                    <input type="text" id="label" name="label" value="{{ old('label') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>

                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-2">Value *</label>
                    <input type="number" id="value" name="value" value="{{ old('value') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>

                <div>
                    <label for="suffix" class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" id="suffix" name="suffix" value="{{ old('suffix') }}" placeholder="+ or %"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>

                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[var(--color-forest-green)] focus:ring-[var(--color-forest-green)]">
                    <span class="ml-2 text-sm text-gray-700">Active (show on site)</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.impact.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                Create Stat
            </button>
        </div>
    </form>
@endsection
