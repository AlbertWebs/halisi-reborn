@props(['journey'])

<a href="{{ route('journeys.show', $journey) }}" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group h-full flex flex-col">
    @if($journey->hero_image)
        <div class="aspect-video bg-[var(--color-sand-beige)] overflow-hidden relative">
            @php
                $imageUrl = str_starts_with($journey->hero_image, 'http') 
                    ? $journey->hero_image 
                    : asset('storage/' . $journey->hero_image);
            @endphp
            <img src="{{ $imageUrl }}" alt="{{ $journey->title }}" loading="lazy" width="400" height="300" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
    @else
        <div class="aspect-video bg-gradient-to-br from-[var(--color-sand-beige)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)] relative overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center">
                <svg class="w-16 h-16 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    @endif
    <div class="p-6 flex-grow flex flex-col">
        @if($journey->countries->count() > 0)
            <div class="mb-3">
                <span class="inline-block px-3 py-1 text-xs uppercase tracking-wide text-[var(--color-accent-gold)] font-semibold bg-[var(--color-off-white)] rounded-full">
                    {{ $journey->countries->pluck('name')->join(', ') }}
                </span>
            </div>
        @endif
        <h3 class="text-xl md:text-2xl font-serif font-bold text-[var(--color-forest-green)] mb-3 group-hover:text-[var(--color-accent-gold)] transition-colors line-clamp-2">
            {{ $journey->title }}
        </h3>
        <p class="text-sm md:text-base text-[var(--color-earth-brown)] leading-relaxed mb-4 line-clamp-3 flex-grow">
            {{ Str::limit(strip_tags($journey->narrative_intro), 150) }}
        </p>
        <div class="mt-auto pt-4 border-t border-[var(--color-sand-beige)]">
            <span class="text-[var(--color-forest-green)] font-semibold text-sm md:text-base inline-flex items-center group-hover:text-[var(--color-accent-gold)] transition-colors">
                Explore Journey
                <svg class="ml-2 w-5 h-5 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </span>
        </div>
    </div>
</a>
