@extends('admin.layouts.admin')

@section('title', 'Welcome section — 4 images')
@section('page-title', 'Welcome section — 2×2 image grid')

@section('content')
    <div class="mb-6 max-w-3xl">
        <p class="text-sm text-gray-600">
            These four images appear in the <strong>Welcome</strong> block on the homepage (next to the intro text).
            Each tile can have its own image, label, and link. If you leave an image empty, the matching
            <a href="{{ route('admin.homepage.index') }}" class="text-[var(--color-forest-green)] font-medium hover:underline">pillar section</a> image is used when available.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-50 text-green-800 text-sm">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.homepage.welcome-grid.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($tileKeys as $key)
                @php
                    $section = $tiles->get($key);
                    $def = $definitions[$key] ?? ['title' => $key, 'help' => ''];
                @endphp
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $def['title'] }} tile</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $def['help'] }}</p>
                        <p class="text-xs text-gray-400 mt-1 font-mono">{{ $key }}</p>
                    </div>

                    @if($section && $section->image)
                        <div>
                            <p class="text-xs font-medium text-gray-600 mb-2">Current image</p>
                            @php
                                $currentSrc = \Illuminate\Support\Str::startsWith($section->image, ['http://', 'https://'])
                                    ? $section->image
                                    : asset('storage/' . $section->image);
                            @endphp
                            <img src="{{ $currentSrc }}" alt="" class="w-full max-h-48 object-cover rounded-lg border border-gray-200">
                            <label class="mt-3 inline-flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="checkbox" name="remove_image[{{ $key }}]" value="1" class="rounded border-gray-300 text-[var(--color-forest-green)]">
                                Remove image (use fallback)
                            </label>
                        </div>
                    @endif

                    <div>
                        <label for="image_{{ $key }}" class="block text-sm font-medium text-gray-700 mb-2">Upload image file</label>
                        <input id="image_{{ $key }}" type="file" name="image_{{ $key }}" accept="image/jpeg,image/jpg,image/png,image/webp,image/gif,image/avif,.jpg,.jpeg,.png,.webp,.gif,.avif"
                               class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        <p class="mt-1 text-xs text-gray-500">Choose a file from your computer (not a URL). JPEG, PNG, WebP, GIF, or AVIF. Max 10&nbsp;MB. Square or landscape works best.</p>
                        @error('image_'.$key)
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Label on tile</label>
                        <input type="text" name="titles[{{ $key }}]" value="{{ old('titles.'.$key, $section?->title) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"
                               maxlength="255"
                               placeholder="{{ $def['title'] }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Link (optional)</label>
                        <input type="text" name="cta_links[{{ $key }}]" value="{{ old('cta_links.'.$key, $section?->cta_link) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] font-mono text-sm"
                               maxlength="500"
                               placeholder="/responsible-regenerative-travel or full URL">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex flex-wrap gap-3 pt-4">
            <button type="submit" class="px-6 py-3 rounded-[var(--radius-button)] bg-[var(--color-forest-green)] text-white font-medium hover:bg-opacity-90">
                Save all tiles
            </button>
            <a href="{{ route('admin.homepage.index') }}" class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                Back to homepage sections
            </a>
            <a href="{{ route('home') }}" target="_blank" rel="noopener" class="px-6 py-3 rounded-lg text-[var(--color-forest-green)] font-medium hover:underline">
                View homepage
            </a>
        </div>
    </form>
@endsection
