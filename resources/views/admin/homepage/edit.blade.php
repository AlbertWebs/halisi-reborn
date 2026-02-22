@extends('admin.layouts.admin')

@section('title', 'Edit Homepage Section')
@section('page-title', 'Edit Homepage Section')
@section('breadcrumb', 'Homepage / Edit')

@section('content')
    <form method="POST" action="{{ route('admin.homepage.update', $homepage) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="section_key" class="block text-sm font-medium text-gray-700 mb-2">Section Key *</label>
                        <input type="text" id="section_key" name="section_key" value="{{ old('section_key', $homepage->section_key) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Unique identifier</p>
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $homepage->sort_order) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Content</h3>
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $homepage->title) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                        <textarea id="subtitle" name="subtitle" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('subtitle', $homepage->subtitle) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Use line breaks for multi-line hero callout text.</p>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                        <textarea id="content" name="content" rows="6"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('content', $homepage->content) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                @if($homepage->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $homepage->image) }}" alt="Current image" class="w-64 h-32 object-cover rounded-lg">
                    </div>
                    <label class="flex items-center mt-2">
                        <input type="checkbox" name="remove_image" value="1" {{ old('remove_image') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                        <span class="ml-2 text-sm text-gray-700">Remove current image (use default icon on homepage)</span>
                    </label>
                @endif
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] mt-2">
                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image. Or check "Remove current image" above to clear it.</p>
            </div>

            <!-- CTA -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Call to Action</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="cta_label" class="block text-sm font-medium text-gray-700 mb-2">CTA Label</label>
                        <input type="text" id="cta_label" name="cta_label" value="{{ old('cta_label', $homepage->cta_label) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="cta_link" class="block text-sm font-medium text-gray-700 mb-2">CTA Link</label>
                        <input type="text" id="cta_link" name="cta_link" value="{{ old('cta_link', $homepage->cta_link) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>
                </div>
            </div>

            <!-- Active -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $homepage->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[var(--color-forest-green)] focus:ring-[var(--color-forest-green)]">
                    <span class="ml-2 text-sm text-gray-700">Active (show on homepage)</span>
                </label>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.homepage.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                Update Section
            </button>
        </div>
    </form>
@endsection
