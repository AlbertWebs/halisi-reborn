@props(['name', 'slug', 'image' => null, 'excerpt' => null])

<a href="{{ route('countries.show', $slug) }}" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
    @if($image)
        <div class="aspect-video bg-[var(--color-sand-beige)] overflow-hidden">
            <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-full object-cover">
        </div>
    @else
        <div class="aspect-video bg-[var(--color-sand-beige)]"></div>
    @endif
    <div class="p-6">
        <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">{{ $name }}</h3>
        @if($excerpt)
            <p class="text-sm text-[var(--color-earth-brown)]">{{ $excerpt }}</p>
        @endif
    </div>
</a>
