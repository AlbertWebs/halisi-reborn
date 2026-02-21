@extends('admin.layouts.admin')

@section('title', 'Edit Article')
@section('page-title', 'Edit Article')
@section('breadcrumb', 'Blog / Edit')

@section('content')
    <form method="POST" action="{{ route('admin.trust.update', $trust) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $trust->title) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $trust->slug) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                    <select id="category" name="category" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ old('category', $trust->category) == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Published Date</label>
                    <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $trust->published_at ? $trust->published_at->format('Y-m-d\TH:i') : '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>
            </div>

            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                @if($trust->featured_image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $trust->featured_image) }}" alt="Current featured image" class="w-64 h-32 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" id="featured_image" name="featured_image" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                <textarea id="excerpt" name="excerpt" rows="2"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('excerpt', $trust->excerpt) }}</textarea>
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                <textarea id="content" name="content" rows="15" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('content', $trust->content) }}</textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.trust.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                Update Article
            </button>
        </div>
    </form>
@endsection
