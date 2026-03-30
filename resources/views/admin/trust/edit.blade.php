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
                <input type="hidden" name="is_published" value="0">
                <label class="inline-flex items-center gap-2">
                    <input
                        type="checkbox"
                        name="is_published"
                        value="1"
                        {{ old('is_published', $trust->is_published) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-[var(--color-forest-green)] focus:ring-[var(--color-forest-green)]"
                    >
                    <span class="text-sm text-gray-700">Publish this article</span>
                </label>
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

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Article Images (Dropzone)</label>
                <p class="text-xs text-gray-500 mb-3">Drag and drop images here, then click "Insert into content" to place them in the article body.</p>
                <div
                    id="trust-image-dropzone"
                    class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-[var(--color-forest-green)] hover:bg-gray-50/50 transition-colors cursor-pointer"
                    data-upload-url="{{ route('admin.trust.editor-image') }}"
                >
                    <input type="file" id="trust-image-input" accept="image/jpeg,image/png,image/gif,image/webp,image/*" multiple class="hidden">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Drop images here, or <span class="text-[var(--color-forest-green)] font-medium">browse</span></p>
                    <p class="mt-1 text-xs text-gray-500">JPEG, PNG, GIF, WebP. Max 4MB each.</p>
                </div>
                <p id="trust-image-upload-status" class="mt-2 text-sm text-gray-500 hidden"></p>
                <div id="trust-image-gallery" class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"></div>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.trust.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-[var(--radius-button)] hover:bg-opacity-90 transition-colors font-medium">
                Update Article
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropzone = document.getElementById('trust-image-dropzone');
            var input = document.getElementById('trust-image-input');
            var status = document.getElementById('trust-image-upload-status');
            var gallery = document.getElementById('trust-image-gallery');
            var csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            if (!dropzone || !input || !gallery) return;

            function showStatus(message, ok) {
                status.classList.remove('hidden', 'text-red-600', 'text-green-600');
                status.textContent = message;
                status.classList.add(ok ? 'text-green-600' : 'text-red-600');
            }

            function insertIntoEditor(url) {
                if (!url) return;
                if (typeof tinymce !== 'undefined') {
                    var editor = tinymce.get('content');
                    if (editor) {
                        editor.insertContent('<p><img src="' + url + '" alt="" /></p>');
                        editor.save();
                        return;
                    }
                }

                var textarea = document.getElementById('content');
                if (textarea) {
                    textarea.value += '\n<p><img src="' + url + '" alt="" /></p>\n';
                }
            }

            function addImageCard(url) {
                var card = document.createElement('div');
                card.className = 'rounded-lg border border-gray-200 bg-white p-3 space-y-2';
                card.innerHTML = '' +
                    '<img src="' + url + '" alt="Uploaded image" class="w-full h-36 object-cover rounded border border-gray-200">' +
                    '<div class="flex gap-2">' +
                    '  <button type="button" class="trust-insert-image px-3 py-1.5 text-xs bg-[var(--color-forest-green)] text-white rounded hover:bg-opacity-90">Insert into content</button>' +
                    '  <button type="button" class="trust-copy-image px-3 py-1.5 text-xs border border-gray-300 rounded hover:bg-gray-50">Copy URL</button>' +
                    '</div>' +
                    '<p class="text-[11px] text-gray-500 break-all">' + url + '</p>';

                card.querySelector('.trust-insert-image').addEventListener('click', function() {
                    insertIntoEditor(url);
                    showStatus('Image inserted into content.', true);
                });

                card.querySelector('.trust-copy-image').addEventListener('click', function() {
                    navigator.clipboard.writeText(url).then(function() {
                        showStatus('Image URL copied.', true);
                    }).catch(function() {
                        showStatus('Could not copy URL. Copy manually below image.', false);
                    });
                });

                gallery.prepend(card);
            }

            function uploadFiles(files) {
                if (!files || !files.length) return;

                var allowed = Array.prototype.filter.call(files, function(file) {
                    return file.type && file.type.indexOf('image/') === 0;
                });
                if (!allowed.length) {
                    showStatus('Please upload image files only.', false);
                    return;
                }

                var uploadedCount = 0;
                var failedCount = 0;
                status.classList.add('hidden');

                allowed.forEach(function(file) {
                    var formData = new FormData();
                    formData.append('file', file);

                    fetch(dropzone.getAttribute('data-upload-url'), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin',
                        body: formData
                    }).then(function(response) {
                        if (!response.ok) {
                            throw new Error('Upload failed');
                        }
                        return response.json();
                    }).then(function(json) {
                        if (json && json.location) {
                            addImageCard(json.location);
                            uploadedCount++;
                        } else {
                            failedCount++;
                        }
                    }).catch(function() {
                        failedCount++;
                    }).finally(function() {
                        var done = uploadedCount + failedCount;
                        if (done === allowed.length) {
                            if (uploadedCount > 0) {
                                showStatus(uploadedCount + ' image(s) uploaded. Use "Insert into content" to place them in the article.', true);
                            } else {
                                showStatus('Upload failed. Please try again.', false);
                            }
                        }
                    });
                });
            }

            dropzone.addEventListener('click', function(e) {
                e.preventDefault();
                input.click();
            });
            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropzone.classList.add('border-[var(--color-forest-green)]', 'bg-gray-50');
            });
            dropzone.addEventListener('dragleave', function() {
                dropzone.classList.remove('border-[var(--color-forest-green)]', 'bg-gray-50');
            });
            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropzone.classList.remove('border-[var(--color-forest-green)]', 'bg-gray-50');
                uploadFiles(e.dataTransfer?.files || []);
            });
            input.addEventListener('change', function() {
                uploadFiles(this.files || []);
                this.value = '';
            });
        });
    </script>
@endsection
