@php
    $isEdit = filled($slide ?? null);
@endphp

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Image @if(!$isEdit)<span class="text-red-500">*</span>@endif</label>
    <input type="file" name="image" accept="image/jpeg,image/png,image/webp,image/gif,image/avif,.jpg,.jpeg,.png,.webp,.gif,.avif"
           class="w-full text-sm text-gray-600 border rounded-lg px-2 py-2 @error('image') border-red-500 @else border-gray-200 @enderror"
           @if(!$isEdit) required @endif>
    @error('image')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
    <p class="mt-1 text-xs text-gray-500">JPEG, PNG, WebP, GIF, or AVIF (not iPhone HEIC—export as JPEG first). Max 10&nbsp;MB. If upload fails: run <code class="bg-gray-100 px-1 rounded">php artisan storage:link</code> and set PHP <code class="bg-gray-100 px-1 rounded">upload_max_filesize</code> and <code class="bg-gray-100 px-1 rounded">post_max_size</code> to at least 12M, then restart the server.</p>
    @if($isEdit && $slide->image)
        <p class="mt-2 text-xs text-gray-600">Current:</p>
        <img src="{{ asset('storage/' . $slide->image) }}" alt="" class="mt-1 w-full max-w-md h-32 object-cover rounded border border-gray-200">
    @endif
</div>

<div>
    <label for="image_alt" class="block text-sm font-medium text-gray-700 mb-2">Image alt text</label>
    <input type="text" id="image_alt" name="image_alt" maxlength="255" value="{{ old('image_alt', $isEdit ? $slide->image_alt : '') }}"
           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]">
</div>

<div>
    <label for="overlay_title" class="block text-sm font-medium text-gray-700 mb-2">Overlay title <span class="text-gray-400 font-normal">(optional)</span></label>
    <input type="text" id="overlay_title" name="overlay_title" maxlength="255" value="{{ old('overlay_title', $isEdit ? $slide->overlay_title : '') }}"
           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]">
</div>

<div>
    <label for="overlay_subtitle" class="block text-sm font-medium text-gray-700 mb-2">Overlay subtitle <span class="text-gray-400 font-normal">(optional)</span></label>
    <textarea id="overlay_subtitle" name="overlay_subtitle" rows="2" maxlength="500"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]">{{ old('overlay_subtitle', $isEdit ? $slide->overlay_subtitle : '') }}</textarea>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort order</label>
        <input type="number" id="sort_order" name="sort_order" min="0" value="{{ old('sort_order', $isEdit ? $slide->sort_order : 0) }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]">
    </div>
    <div class="flex items-end pb-2">
        <label class="inline-flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $isEdit ? $slide->is_active : true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[var(--color-forest-green)]">
            <span class="text-sm text-gray-700">Active</span>
        </label>
    </div>
</div>
