@extends('admin.layouts.admin')

@section('title', 'Edit Page')
@section('page-title', 'Edit Page')
@section('breadcrumb', 'Pages / Edit')

@section('content')
    <form method="POST" action="{{ route('admin.pages.update', $page) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $page->title) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $page->slug) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>
                </div>
            </div>

            <!-- Hero Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Hero Section</h3>
                <div class="space-y-4">
                    <div>
                        <label for="hero_title" class="block text-sm font-medium text-gray-700 mb-2">Hero Title</label>
                        <input type="text" id="hero_title" name="hero_title" value="{{ old('hero_title', $page->hero_title) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="hero_subtext" class="block text-sm font-medium text-gray-700 mb-2">Hero Subtext</label>
                        <input type="text" id="hero_subtext" name="hero_subtext" value="{{ old('hero_subtext', $page->hero_subtext) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">Hero Image</label>
                        @if($page->hero_image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $page->hero_image) }}" alt="Current hero image" class="w-64 h-32 object-cover rounded-lg">
                            </div>
                        @endif
                        <input type="file" id="hero_image" name="hero_image" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
                    </div>

                    <div>
                        <label for="content_image_1" class="block text-sm font-medium text-gray-700 mb-2">Content Image 1</label>
                        @if($page->content_image_1)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $page->content_image_1) }}" alt="Current content image 1" class="w-64 h-32 object-cover rounded-lg">
                            </div>
                        @endif
                        <input type="file" id="content_image_1" name="content_image_1" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
                    </div>

                    <div>
                        <label for="content_image_2" class="block text-sm font-medium text-gray-700 mb-2">Content Image 2</label>
                        @if($page->content_image_2)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $page->content_image_2) }}" alt="Current content image 2" class="w-64 h-32 object-cover rounded-lg">
                            </div>
                        @endif
                        <input type="file" id="content_image_2" name="content_image_2" accept="image/jpeg,image/png,image/gif,image/webp,image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
                    </div>
                </div>
            </div>

            <!-- Extra gallery (shown on About page and anywhere you use gallery in the template) -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Extra image gallery</h3>
                <p class="text-sm text-gray-500 mb-4">Add as many images as you need. On the <strong>About Halisi</strong> page they appear in a grid after your story blocks. Drag and drop or click to upload.</p>

                @if($page->galleryImages->count() > 0)
                    <div id="page-gallery-list" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4">
                        @foreach($page->galleryImages as $img)
                            <div class="gallery-item relative group rounded-lg overflow-hidden border border-gray-200 bg-gray-50 aspect-square">
                                <img src="{{ asset('storage/' . $img->image) }}" alt="Gallery" class="w-full h-full object-cover">
                                <form method="POST" action="{{ route('admin.pages.gallery.destroy', $img) }}" class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Remove this image from the gallery?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">Remove</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div id="page-gallery-list" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4"></div>
                @endif

                <div id="page-gallery-dropzone" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-[var(--color-forest-green)] hover:bg-gray-50/50 transition-colors cursor-pointer" data-upload-url="{{ route('admin.pages.gallery.store', $page) }}" data-destroy-url-template="{{ url('/admin/pages/gallery') }}/__ID__">
                    <input type="file" id="page-gallery-input" accept="image/jpeg,image/png,image/gif,image/webp,image/avif" multiple class="hidden">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="mt-2 text-sm text-gray-600">Drag and drop images here, or <span class="text-[var(--color-forest-green)] font-medium">browse</span></p>
                    <p class="mt-1 text-xs text-gray-500">JPEG, PNG, GIF, WebP, AVIF. Max 2MB each.</p>
                </div>
                <div id="page-gallery-upload-progress" class="mt-2 hidden">
                    <div class="flex items-center justify-between text-sm text-gray-600 mb-1">
                        <span id="page-gallery-upload-progress-label">Uploading...</span>
                        <span id="page-gallery-upload-progress-pct">0%</span>
                    </div>
                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div id="page-gallery-upload-progress-bar" class="h-full bg-[var(--color-forest-green)] transition-all duration-200 ease-out" style="width: 0%"></div>
                    </div>
                </div>
                <p id="page-gallery-upload-status" class="mt-2 text-sm text-gray-500 hidden"></p>
            </div>

            <!-- Content -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Content</h3>
                <div>
                    <label for="body_content" class="block text-sm font-medium text-gray-700 mb-2">Body Content</label>
                    <textarea id="body_content" name="body_content" rows="12"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('body_content', $page->body_content) }}</textarea>
                </div>
            </div>

            <!-- Trust Page Settings -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Trust Page Settings (optional)</h3>
                <div class="space-y-4">
                    <div>
                        <label for="featured_label" class="block text-sm font-medium text-gray-700 mb-2">Featured Section Label</label>
                        <input type="text" id="featured_label" name="featured_label" value="{{ old('featured_label', $page->featured_label) }}"
                               placeholder="Featured Article"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>
                    <div>
                        <label for="latest_articles_title" class="block text-sm font-medium text-gray-700 mb-2">Latest Articles Heading</label>
                        <input type="text" id="latest_articles_title" name="latest_articles_title" value="{{ old('latest_articles_title', $page->latest_articles_title) }}"
                               placeholder="Latest Articles"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>
                    <div>
                        <label for="latest_articles_description" class="block text-sm font-medium text-gray-700 mb-2">Latest Articles Description</label>
                        <textarea id="latest_articles_description" name="latest_articles_description" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('latest_articles_description', $page->latest_articles_description) }}</textarea>
                    </div>
                    <div>
                        <label for="empty_state_message" class="block text-sm font-medium text-gray-700 mb-2">Empty State Message</label>
                        <textarea id="empty_state_message" name="empty_state_message" rows="2"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('empty_state_message', $page->empty_state_message) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Contact Page Settings -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Page Settings (optional)</h3>
                <div class="space-y-4">
                    <div>
                        <label for="contact_section_title" class="block text-sm font-medium text-gray-700 mb-2">Get In Touch Section Title</label>
                        <input type="text" id="contact_section_title" name="contact_section_title" value="{{ old('contact_section_title', $page->contact_section_title) }}"
                               placeholder="Get In Touch"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>
                    <div>
                        <label for="contact_section_intro" class="block text-sm font-medium text-gray-700 mb-2">Get In Touch Intro</label>
                        <textarea id="contact_section_intro" name="contact_section_intro" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('contact_section_intro', $page->contact_section_intro) }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="contact_form_title" class="block text-sm font-medium text-gray-700 mb-2">Form Title</label>
                            <input type="text" id="contact_form_title" name="contact_form_title" value="{{ old('contact_form_title', $page->contact_form_title) }}"
                                   placeholder="Send Us a Message"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        </div>
                        <div>
                            <label for="contact_form_button_label" class="block text-sm font-medium text-gray-700 mb-2">Form Button Label</label>
                            <input type="text" id="contact_form_button_label" name="contact_form_button_label" value="{{ old('contact_form_button_label', $page->contact_form_button_label) }}"
                                   placeholder="Send Message"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        </div>
                    </div>
                    <div>
                        <label for="contact_form_intro" class="block text-sm font-medium text-gray-700 mb-2">Form Intro</label>
                        <textarea id="contact_form_intro" name="contact_form_intro" rows="2"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('contact_form_intro', $page->contact_form_intro) }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="contact_email_label" class="block text-sm font-medium text-gray-700 mb-2">Email Label</label>
                            <input type="text" id="contact_email_label" name="contact_email_label" value="{{ old('contact_email_label', $page->contact_email_label) }}"
                                   placeholder="Email"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        </div>
                        <div>
                            <label for="contact_phone_label" class="block text-sm font-medium text-gray-700 mb-2">Phone Label</label>
                            <input type="text" id="contact_phone_label" name="contact_phone_label" value="{{ old('contact_phone_label', $page->contact_phone_label) }}"
                                   placeholder="Phone"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        </div>
                        <div>
                            <label for="contact_address_label" class="block text-sm font-medium text-gray-700 mb-2">Address Label</label>
                            <input type="text" id="contact_address_label" name="contact_address_label" value="{{ old('contact_address_label', $page->contact_address_label) }}"
                                   placeholder="Address"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        </div>
                        <div>
                            <label for="contact_hours_label" class="block text-sm font-medium text-gray-700 mb-2">Office Hours Label</label>
                            <input type="text" id="contact_hours_label" name="contact_hours_label" value="{{ old('contact_hours_label', $page->contact_hours_label) }}"
                                   placeholder="Office Hours"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                        </div>
                    </div>
                    <div>
                        <label for="contact_social_label" class="block text-sm font-medium text-gray-700 mb-2">Social Label</label>
                        <input type="text" id="contact_social_label" name="contact_social_label" value="{{ old('contact_social_label', $page->contact_social_label) }}"
                               placeholder="Follow Us"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>
                    <div>
                        <label for="contact_map_embed_url" class="block text-sm font-medium text-gray-700 mb-2">Map Embed URL</label>
                        <textarea id="contact_map_embed_url" name="contact_map_embed_url" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('contact_map_embed_url', $page->contact_map_embed_url) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('meta_description', $page->meta_description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Publish -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $page->is_published) ? 'checked' : '' }}
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
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-[var(--radius-button)] hover:bg-opacity-90 transition-colors font-medium">
                Update Page
            </button>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropzone = document.getElementById('page-gallery-dropzone');
        var input = document.getElementById('page-gallery-input');
        var list = document.getElementById('page-gallery-list');
        var status = document.getElementById('page-gallery-upload-status');
        var progressWrap = document.getElementById('page-gallery-upload-progress');
        var progressBar = document.getElementById('page-gallery-upload-progress-bar');
        var progressPct = document.getElementById('page-gallery-upload-progress-pct');
        var progressLabel = document.getElementById('page-gallery-upload-progress-label');

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
