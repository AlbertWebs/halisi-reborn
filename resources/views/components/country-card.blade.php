@props(['name', 'slug', 'image' => null, 'excerpt' => null])

<a href="{{ route('countries.show', $slug) }}" class="block relative aspect-[4/3] bg-[var(--color-sand-beige)] rounded-lg overflow-hidden group">
    @if($image)
        <img src="{{ $image }}" alt="{{ $name }}" loading="lazy" width="400" height="300" class="w-full h-full object-cover hover-zoom">
    @else
        <div class="w-full h-full bg-gradient-to-br from-[var(--color-sand-beige)] to-[var(--color-earth-brown)] opacity-60"></div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
        <h3 class="text-2xl font-serif font-bold mb-2">{{ $name }}</h3>
        @if($excerpt)
            <p class="text-sm text-gray-200">{{ $excerpt }}</p>
        @endif
    </div>
</a>
