@extends('admin.layouts.admin')

@section('title', 'Edit Journey')
@section('page-title', 'Edit Journey')
@section('breadcrumb', 'Journeys / Edit')

@section('content')
    <form method="POST" action="{{ route('admin.journeys.update', $journey) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $journey->title) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $journey->slug) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="journey_category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select id="journey_category" name="journey_category" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ old('journey_category', $journey->journey_category) == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $journey->sort_order) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>
                </div>
            </div>

            <!-- Hero Image -->
            <div>
                <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">Hero Image</label>
                @if($journey->hero_image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $journey->hero_image) }}" alt="Current hero image" class="w-64 h-32 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" id="hero_image" name="hero_image" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
            </div>

            <!-- Content -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Content</h3>
                <div class="space-y-4">
                    <div>
                        <label for="narrative_intro" class="block text-sm font-medium text-gray-700 mb-2">Narrative Introduction *</label>
                        <textarea id="narrative_intro" name="narrative_intro" rows="6" required
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('narrative_intro', $journey->narrative_intro) }}</textarea>
                    </div>

                    <div>
                        <label for="experience_highlights" class="block text-sm font-medium text-gray-700 mb-2">Experience Highlights</label>
                        <textarea id="experience_highlights" name="experience_highlights" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('experience_highlights', $journey->experience_highlights) }}</textarea>
                    </div>

                    <div>
                        <label for="regenerative_impact" class="block text-sm font-medium text-gray-700 mb-2">Regenerative Impact</label>
                        <textarea id="regenerative_impact" name="regenerative_impact" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('regenerative_impact', $journey->regenerative_impact) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Countries -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Associated Countries</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($countries as $country)
                        <label class="flex items-center">
                            <input type="checkbox" name="countries[]" value="{{ $country->id }}" {{ in_array($country->id, old('countries', $selectedCountries)) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-[var(--color-forest-green)] focus:ring-[var(--color-forest-green)]">
                            <span class="ml-2 text-sm text-gray-700">{{ $country->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- CTA -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Call to Action</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="cta_label" class="block text-sm font-medium text-gray-700 mb-2">CTA Label</label>
                        <input type="text" id="cta_label" name="cta_label" value="{{ old('cta_label', $journey->cta_label) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="cta_link" class="block text-sm font-medium text-gray-700 mb-2">CTA Link</label>
                        <input type="text" id="cta_link" name="cta_link" value="{{ old('cta_link', $journey->cta_link) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>
                </div>
            </div>

            <!-- Publish -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $journey->is_published) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[var(--color-forest-green)] focus:ring-[var(--color-forest-green)]">
                    <span class="ml-2 text-sm text-gray-700">Publish immediately</span>
                </label>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.journeys.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                Update Journey
            </button>
        </div>
    </form>
@endsection
