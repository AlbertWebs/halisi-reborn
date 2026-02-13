@extends('admin.layouts.admin')

@section('title', 'Create Country')
@section('page-title', 'Create Country')
@section('breadcrumb', 'Countries / Create')

@section('content')
    <form method="POST" action="{{ route('admin.countries.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Country Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to auto-generate</p>
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>
                </div>
            </div>

            <!-- Hero Image -->
            <div>
                <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">Hero Image</label>
                <input type="file" id="hero_image" name="hero_image" accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                <p class="text-xs text-gray-500 mt-1">Recommended: 1920x1080px, max 2MB</p>
            </div>

            <!-- Content -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Content</h3>
                <div class="space-y-4">
                    <div>
                        <label for="country_narrative" class="block text-sm font-medium text-gray-700 mb-2">Country Narrative *</label>
                        <textarea id="country_narrative" name="country_narrative" rows="6" required
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('country_narrative') }}</textarea>
                    </div>

                    <div>
                        <label for="signature_experiences" class="block text-sm font-medium text-gray-700 mb-2">Signature Experiences</label>
                        <textarea id="signature_experiences" name="signature_experiences" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('signature_experiences') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">HTML is allowed</p>
                    </div>

                    <div>
                        <label for="conservation_focus" class="block text-sm font-medium text-gray-700 mb-2">Conservation Focus</label>
                        <textarea id="conservation_focus" name="conservation_focus" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('conservation_focus') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Journeys -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Associated Journeys</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-48 overflow-y-auto border border-gray-200 rounded-lg p-4">
                    @foreach($journeys as $journey)
                        <label class="flex items-center">
                            <input type="checkbox" name="journeys[]" value="{{ $journey->id }}" {{ in_array($journey->id, old('journeys', [])) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-[var(--color-forest-green)] focus:ring-[var(--color-forest-green)]">
                            <span class="ml-2 text-sm text-gray-700">{{ $journey->title }}</span>
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
                        <input type="text" id="cta_label" name="cta_label" value="{{ old('cta_label') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="cta_link" class="block text-sm font-medium text-gray-700 mb-2">CTA Link</label>
                        <input type="text" id="cta_link" name="cta_link" value="{{ old('cta_link') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
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
            <a href="{{ route('admin.countries.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                Create Country
            </button>
        </div>
    </form>
@endsection
