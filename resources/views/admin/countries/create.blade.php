@extends('admin.layouts.admin')

@section('title', 'Create Country')
@section('page-title', 'Create Country')
@section('breadcrumb', 'Countries / Create')

@section('content')
    <form method="POST" action="{{ route('admin.countries.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="font-semibold text-red-800 mb-2">The form could not be submitted. Please fix the following:</p>
                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Country Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] @error('name') border-red-500 @else border-gray-300 @enderror">
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] @error('slug') border-red-500 @else border-gray-300 @enderror">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to auto-generate</p>
                        @error('slug')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] @error('sort_order') border-red-500 @else border-gray-300 @enderror">
                        @error('sort_order')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Hero Media -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Hero Media</h3>
                <div class="space-y-4">
                    <div>
                        <label for="hero_video" class="block text-sm font-medium text-gray-700 mb-2">Hero Video (Vimeo URL)</label>
                        <input type="text" id="hero_video" name="hero_video" value="{{ old('hero_video') }}"
                               placeholder="https://vimeo.com/123456789 or https://player.vimeo.com/video/123456789"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Enter a Vimeo video URL. Video takes priority over image if both are set.</p>
                    </div>
                    
                    <div>
                        <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">Hero Image (Fallback)</label>
                        <input type="file" id="hero_image" name="hero_image" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] @error('hero_image') border-red-500 @else border-gray-300 @enderror">
                        <p class="text-xs text-gray-500 mt-1">Recommended: 1920x1080px, max 2MB. Used if no video is set.</p>
                        @error('hero_image')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="hero_subtitle" class="block text-sm font-medium text-gray-700 mb-2">Hero Subtitle</label>
                        <textarea id="hero_subtitle" name="hero_subtitle" rows="2"
                                  placeholder="Short description shown in hero section"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('hero_subtitle') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Leave empty to auto-generate from narrative.</p>
                    </div>
                </div>
            </div>

            <!-- Narrative Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Narrative Section</h3>
                <div class="space-y-4">
                    <div>
                        <label for="country_narrative" class="block text-sm font-medium text-gray-700 mb-2">Country Narrative *</label>
                        <textarea id="country_narrative" name="country_narrative" rows="6"
                                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] @error('country_narrative') border-red-500 @else border-gray-300 @enderror">{{ old('country_narrative') }}</textarea>
                        @error('country_narrative')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="narrative_image" class="block text-sm font-medium text-gray-700 mb-2">Narrative Section Image</label>
                        <input type="file" id="narrative_image" name="narrative_image" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] @error('narrative_image') border-red-500 @else border-gray-300 @enderror">
                        <p class="text-xs text-gray-500 mt-1">Used in narrative section.</p>
                        @error('narrative_image')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Signature Experiences Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Signature Experiences Section</h3>
                <div class="space-y-4">
                    <div>
                        <label for="signature_experiences_title" class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                        <input type="text" id="signature_experiences_title" name="signature_experiences_title" value="{{ old('signature_experiences_title') }}"
                               placeholder="Signature Experiences"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty for default title.</p>
                    </div>

                    <div>
                        <label for="signature_experiences" class="block text-sm font-medium text-gray-700 mb-2">Signature Experiences Content</label>
                        <textarea id="signature_experiences" name="signature_experiences" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('signature_experiences') }}</textarea>
                    </div>

                    <p class="text-sm text-gray-500 mb-4">Each card can have a video (Vimeo URL) or image as background. Video takes priority over image. Leave both empty for gradient placeholder.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach([1, 2, 3, 4] as $i)
                            @php
                                $defaultLabels = ['Wildlife Encounters', 'Cultural Immersion', 'Adventure Activities', 'Luxury Lodging'];
                            @endphp
                            <div class="border border-gray-200 rounded-lg p-4 space-y-3">
                                <h4 class="font-medium text-gray-800">Card {{ $i }}</h4>
                                <div>
                                    <label for="signature_card_{{ $i }}_label" class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                                    <input type="text" id="signature_card_{{ $i }}_label" name="signature_card_{{ $i }}_label" value="{{ old("signature_card_{$i}_label") }}"
                                           placeholder="{{ $defaultLabels[$i - 1] }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                                </div>
                                <div>
                                    <label for="signature_card_{{ $i }}_video" class="block text-sm font-medium text-gray-700 mb-1">Video (Vimeo URL)</label>
                                    <input type="text" id="signature_card_{{ $i }}_video" name="signature_card_{{ $i }}_video" value="{{ old("signature_card_{$i}_video") }}"
                                           placeholder="https://vimeo.com/123456789"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                                </div>
                                <div>
                                    <label for="signature_card_{{ $i }}_image" class="block text-sm font-medium text-gray-700 mb-1">Image (fallback)</label>
                                    <input type="file" id="signature_card_{{ $i }}_image" name="signature_card_{{ $i }}_image" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] @error("signature_card_{$i}_image") border-red-500 @else border-gray-300 @enderror">
                                    @error("signature_card_{$i}_image")
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Conservation & Community Focus (country page section) -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Conservation & Community Focus</h3>
                <p class="text-sm text-gray-500 mb-4">This section appears on the country page. Fill in the content below to show it.</p>
                <div class="space-y-4">
                    <div>
                        <label for="conservation_title" class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                        <input type="text" id="conservation_title" name="conservation_title" value="{{ old('conservation_title') }}"
                               placeholder="Conservation & Community Focus"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty for default title.</p>
                    </div>

                    <div>
                        <label for="conservation_focus" class="block text-sm font-medium text-gray-700 mb-2">Main content (body text)</label>
                        <textarea id="conservation_focus" name="conservation_focus" rows="6"
                                  placeholder="Describe conservation and community initiatives for this country..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('conservation_focus') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">HTML allowed. Leave empty to hide this section on the country page.</p>
                    </div>

                    <div>
                        <label for="conservation_visual_text" class="block text-sm font-medium text-gray-700 mb-2">Left panel text (visual block)</label>
                        <textarea id="conservation_visual_text" name="conservation_visual_text" rows="3"
                                  placeholder="Text shown in the coloured panel on the left"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('conservation_visual_text') }}</textarea>
                    </div>

                    <div>
                        <label for="conservation_image" class="block text-sm font-medium text-gray-700 mb-2">Section Image</label>
                        <input type="file" id="conservation_image" name="conservation_image" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Optional image for the Conservation & Community Focus section.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="conservation_button_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                            <input type="text" id="conservation_button_text" name="conservation_button_text" value="{{ old('conservation_button_text') }}"
                                   placeholder="Learn About Our Impact Approach"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        </div>
                        <div>
                            <label for="conservation_button_link" class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
                            <input type="text" id="conservation_button_link" name="conservation_button_link" value="{{ old('conservation_button_link') }}"
                                   placeholder="/impact/responsible-travel"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                            <p class="text-xs text-gray-500 mt-1">Leave empty for default impact page.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Journeys Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Featured Journeys Section</h3>
                <div class="space-y-4">
                    <div>
                        <label for="featured_journeys_title" class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                        <input type="text" id="featured_journeys_title" name="featured_journeys_title" value="{{ old('featured_journeys_title') }}"
                               placeholder="Featured Journeys"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty for default title.</p>
                    </div>

                    <div>
                        <label for="featured_journeys_button_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                        <input type="text" id="featured_journeys_button_text" name="featured_journeys_button_text" value="{{ old('featured_journeys_button_text') }}"
                               placeholder="View All Journeys"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty for default text.</p>
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

            <!-- CTA Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Call to Action Section</h3>
                <div class="space-y-4">
                    <div>
                        <label for="cta_title" class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                        <input type="text" id="cta_title" name="cta_title" value="{{ old('cta_title') }}"
                               placeholder="Explore Journeys"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty for default title.</p>
                    </div>

                    <div>
                        <label for="cta_description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="cta_description" name="cta_description" rows="3"
                                  placeholder="Let us design a bespoke journey..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('cta_description') }}</textarea>
                    </div>

                    <div>
                        <label for="cta_button_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                        <input type="text" id="cta_button_text" name="cta_button_text" value="{{ old('cta_button_text') }}"
                               placeholder="Design Your Journey"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty for default text.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="cta_label" class="block text-sm font-medium text-gray-700 mb-2">CTA Label (Legacy)</label>
                            <input type="text" id="cta_label" name="cta_label" value="{{ old('cta_label') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        </div>

                        <div>
                            <label for="cta_link" class="block text-sm font-medium text-gray-700 mb-2">CTA Link</label>
                            <input type="text" id="cta_link" name="cta_link" value="{{ old('cta_link') }}"
                                   placeholder="/contact?country=slug"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        </div>
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
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium cursor-pointer focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:ring-offset-2">
                Create Country
            </button>
        </div>
    </form>
@endsection
