@extends('admin.layouts.admin')

@section('title', 'Create Page')
@section('page-title', 'Create Page')
@section('breadcrumb', 'Pages / Create')

@section('content')
    <form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to auto-generate from title</p>
                    </div>
                </div>
            </div>

            <!-- Hero Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Hero Section</h3>
                <div class="space-y-4">
                    <div>
                        <label for="hero_title" class="block text-sm font-medium text-gray-700 mb-2">Hero Title</label>
                        <input type="text" id="hero_title" name="hero_title" value="{{ old('hero_title') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="hero_subtext" class="block text-sm font-medium text-gray-700 mb-2">Hero Subtext</label>
                        <input type="text" id="hero_subtext" name="hero_subtext" value="{{ old('hero_subtext') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">Hero Image</label>
                        <input type="file" id="hero_image" name="hero_image" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Recommended: 1920x1080px, max 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Content</h3>
                <div>
                    <label for="body_content" class="block text-sm font-medium text-gray-700 mb-2">Body Content</label>
                    <textarea id="body_content" name="body_content" rows="12"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('body_content') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">HTML is allowed</p>
                </div>
            </div>

            <!-- SEO -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Publish -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[var(--color-forest-green)] focus:ring-[var(--color-forest-green)]">
                    <span class="ml-2 text-sm text-gray-700">Publish immediately</span>
                </label>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.pages.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                Create Page
            </button>
        </div>
    </form>
@endsection
