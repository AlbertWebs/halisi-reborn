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
                        <label for="journey_category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select id="journey_category_id" name="journey_category_id" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('journey_category_id', $journey->journey_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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

            <!-- Hero Media (video takes priority over image) -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Hero Media</h3>
                <p class="text-xs text-gray-500 mb-4">If both video and image are set, video is shown. Clear video to use the image.</p>
                <div class="space-y-4">
                    <div>
                        <label for="hero_video" class="block text-sm font-medium text-gray-700 mb-2">Hero Video (Vimeo URL)</label>
                        <input type="text" id="hero_video" name="hero_video" value="{{ old('hero_video', $journey->hero_video) }}"
                               placeholder="https://vimeo.com/123456789"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Takes priority over hero image when set.</p>
                    </div>
                    <div>
                        <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">Hero Image (fallback)</label>
                        @if($journey->hero_image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $journey->hero_image) }}" alt="Current hero image" class="w-64 h-32 object-cover rounded-lg">
                            </div>
                        @endif
                        <input type="file" id="hero_image" name="hero_image" accept="image/jpeg,image/png,image/gif,image/webp,image/avif,image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image. Used when no video is set.</p>
                    </div>
                </div>
            </div>

            <!-- Gallery -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Gallery</h3>
                <p class="text-sm text-gray-500 mb-4">Add multiple images. They will appear in a gallery on the journey page, before the Experience section. Drag and drop or click to upload.</p>

                @if($journey->galleryImages->count() > 0)
                    <div id="gallery-list" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4">
                        @foreach($journey->galleryImages as $img)
                            <div class="gallery-item relative group rounded-lg overflow-hidden border border-gray-200 bg-gray-50 aspect-square">
                                <img src="{{ asset('storage/' . $img->image) }}" alt="Gallery" class="w-full h-full object-cover">
                                <form method="POST" action="{{ route('admin.journeys.gallery.destroy', $img) }}" class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Remove this image from the gallery?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">Remove</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div id="gallery-list" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4"></div>
                @endif

                <div id="gallery-dropzone" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-[var(--color-forest-green)] hover:bg-gray-50/50 transition-colors cursor-pointer" data-upload-url="{{ route('admin.journeys.gallery.store', $journey) }}" data-destroy-url-template="{{ route('admin.journeys.gallery.destroy', ['journey_image' => '__ID__']) }}">
                    <input type="file" id="gallery-input" accept="image/jpeg,image/png,image/gif,image/webp,image/avif" multiple class="hidden">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="mt-2 text-sm text-gray-600">Drag and drop images here, or <span class="text-[var(--color-forest-green)] font-medium">browse</span></p>
                    <p class="mt-1 text-xs text-gray-500">JPEG, PNG, GIF, WebP, AVIF. Max 2MB each.</p>
                </div>
                <div id="gallery-upload-progress" class="mt-2 hidden">
                    <div class="flex items-center justify-between text-sm text-gray-600 mb-1">
                        <span id="gallery-upload-progress-label">Uploading...</span>
                        <span id="gallery-upload-progress-pct">0%</span>
                    </div>
                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div id="gallery-upload-progress-bar" class="h-full bg-[var(--color-forest-green)] transition-all duration-200 ease-out" style="width: 0%"></div>
                    </div>
                </div>
                <p id="gallery-upload-status" class="mt-2 text-sm text-gray-500 hidden"></p>
            </div>

            <!-- Sample Itinerary -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Sample Itinerary</h3>
                <p class="text-sm text-gray-500 mb-4">Add day-by-day itinerary items. These appear on the public journey page.</p>

                @if($journey->itineraryItems->count() > 0)
                    <div class="overflow-x-auto border border-gray-200 rounded-lg mb-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Day</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Content</th>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($journey->itineraryItems as $item)
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $item->day }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ Str::limit($item->title, 40) }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-500">{{ Str::limit(strip_tags($item->content), 60) }}</td>
                                        <td class="px-4 py-3 text-right text-sm">
                                            <a href="{{ route('admin.journeys.itinerary.edit', [$journey, $item]) }}" class="text-[var(--color-forest-green)] hover:underline mr-3">Edit</a>
                                            <form method="POST" action="{{ route('admin.journeys.itinerary.destroy', [$journey, $item]) }}" class="inline" onsubmit="return confirm('Remove this itinerary day?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <p class="text-sm font-medium text-gray-700 mb-3">Add itinerary day</p>
                    <form method="POST" action="{{ route('admin.journeys.itinerary.store', $journey) }}" class="space-y-3">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="itinerary_day" class="block text-xs font-medium text-gray-600 mb-1">Day number</label>
                                <input type="number" id="itinerary_day" name="day" min="1" value="{{ old('day', $journey->itineraryItems->count() + 1) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] text-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label for="itinerary_title" class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                                <input type="text" id="itinerary_title" name="title" value="{{ old('title') }}" required placeholder="e.g. Arr Nairobi – Fly to Masai Mara"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] text-sm">
                            </div>
                        </div>
                        <div>
                            <label for="itinerary_content" class="block text-xs font-medium text-gray-600 mb-1">Content</label>
                            <textarea id="itinerary_content" name="content" rows="3" placeholder="Describe the day's activities..."
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] text-sm">{{ old('content') }}</textarea>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-[var(--color-forest-green)] text-white text-sm font-medium rounded-lg hover:opacity-90">Add day</button>
                    </form>
                </div>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropzone = document.getElementById('gallery-dropzone');
        var input = document.getElementById('gallery-input');
        var list = document.getElementById('gallery-list');
        var status = document.getElementById('gallery-upload-status');
        var progressWrap = document.getElementById('gallery-upload-progress');
        var progressBar = document.getElementById('gallery-upload-progress-bar');
        var progressPct = document.getElementById('gallery-upload-progress-pct');
        var progressLabel = document.getElementById('gallery-upload-progress-label');

        if (!dropzone || !input) return;

        var uploadUrl = dropzone.getAttribute('data-upload-url');
        var destroyUrlTemplate = dropzone.getAttribute('data-destroy-url-template') || '';
        var csrfToken = document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').content;
        var formToken = document.querySelector('input[name="_token"]') && document.querySelector('input[name="_token"]').value;

        function showProgress(show) {
            if (progressWrap) progressWrap.classList.toggle('hidden', !show);
            if (show && progressBar) progressBar.style.width = '0%';
            if (show && progressPct) progressPct.textContent = '0%';
            if (show && progressLabel) progressLabel.textContent = 'Uploading...';
        }
        function updateProgress(loaded, total) {
            var pct = total ? Math.round((loaded / total) * 100) : 0;
            if (progressBar) progressBar.style.width = pct + '%';
            if (progressPct) progressPct.textContent = pct + '%';
        }

        function appendImages(dataImages, token) {
            (dataImages || []).forEach(function(img) {
                var actionUrl = destroyUrlTemplate.replace('__ID__', img.id);
                var div = document.createElement('div');
                div.className = 'gallery-item relative group rounded-lg overflow-hidden border border-gray-200 bg-gray-50 aspect-square';
                div.innerHTML = '<img src="' + (img.url || '') + '" alt="Gallery" class="w-full h-full object-cover">' +
                    '<form method="POST" action="' + actionUrl + '" class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm(\'Remove this image from the gallery?\');">' +
                    '<input type="hidden" name="_token" value="' + token + '">' +
                    '<input type="hidden" name="_method" value="DELETE">' +
                    '<button type="submit" class="px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">Remove</button>' +
                    '</form>';
                list.appendChild(div);
            });
        }

        function uploadFiles(files) {
            if (!files || !files.length) return;
            var formData = new FormData();
            formData.append('_token', csrfToken || formToken);
            for (var i = 0; i < files.length; i++) formData.append('gallery[]', files[i]);

            status.classList.add('hidden');
            status.classList.remove('text-green-600', 'text-red-600');
            showProgress(true);
            updateProgress(0, 100);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', uploadUrl);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken || formToken);

            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) updateProgress(e.loaded, e.total);
                else updateProgress(e.loaded, e.loaded);
            });

            xhr.addEventListener('load', function() {
                showProgress(false);
                status.classList.remove('hidden');
                try {
                    var data = JSON.parse(xhr.responseText || '{}');
                    if (xhr.status >= 200 && xhr.status < 300) {
                        status.textContent = (data.images && data.images.length) ? data.images.length + ' image(s) added.' : 'Done.';
                        status.classList.add('text-green-600');
                        appendImages(data.images, csrfToken || formToken);
                        input.value = '';
                    } else {
                        status.textContent = data.message || (data.errors ? JSON.stringify(data.errors) : 'Upload failed.');
                        status.classList.add('text-red-600');
                    }
                } catch (err) {
                    status.textContent = 'Upload failed. Try again.';
                    status.classList.add('text-red-600');
                }
            });

            xhr.addEventListener('error', function() {
                showProgress(false);
                status.classList.remove('hidden');
                status.textContent = 'Upload failed. Try again.';
                status.classList.add('text-red-600');
            });

            xhr.addEventListener('abort', function() {
                showProgress(false);
                status.classList.remove('hidden');
                status.textContent = 'Upload cancelled.';
                status.classList.add('text-red-600');
            });

            xhr.send(formData);
        }

        dropzone.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            input.click();
        });
        dropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.add('border-[var(--color-forest-green)]', 'bg-gray-50');
        });
        dropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            dropzone.classList.remove('border-[var(--color-forest-green)]', 'bg-gray-50');
        });
        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('border-[var(--color-forest-green)]', 'bg-gray-50');
            var files = [].filter.call(e.dataTransfer.files || [], function(f) { return f.type && f.type.indexOf('image/') === 0; });
            uploadFiles(files);
        });
        input.addEventListener('change', function() {
            uploadFiles(this.files || []);
            this.value = '';
        });
    });
    </script>
@endsection
