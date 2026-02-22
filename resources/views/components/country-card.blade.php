@props(['name', 'slug', 'image' => null, 'excerpt' => null])

@php
    $imageSrc = null;
    if ($image) {
        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            $imageSrc = $image;
        } elseif (str_starts_with($image, '/storage/')) {
            $imageSrc = asset(ltrim($image, '/'));
        } elseif (str_starts_with($image, 'storage/')) {
            $imageSrc = asset($image);
        } else {
            $imageSrc = asset('storage/' . ltrim($image, '/'));
        }
    }

    $cleanExcerpt = null;
    if (filled($excerpt)) {
        $cleanExcerpt = trim(preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($excerpt))));
        $cleanExcerpt = \Illuminate\Support\Str::limit($cleanExcerpt, 100);
    }
@endphp

<a href="{{ route('countries.show', $slug) }}" class="block relative aspect-[4/3] bg-[var(--color-sand-beige)] rounded-lg overflow-hidden group">
    @if($imageSrc)
        <img src="{{ $imageSrc }}" alt="{{ $name }}" loading="lazy" width="400" height="300" class="w-full h-full object-cover hover-zoom">
    @else
        <div class="w-full h-full bg-gradient-to-br from-[var(--color-sand-beige)] to-[var(--color-earth-brown)] opacity-60"></div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
        <h3 class="text-2xl font-serif font-bold mb-2">{{ $name }}</h3>
        @if($cleanExcerpt)
            <p class="text-sm text-gray-200">{{ $cleanExcerpt }}</p>
        @endif
    </div>
</a>
