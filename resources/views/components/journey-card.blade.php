@props(['journey'])

<a href="{{ route('journeys.show', $journey) }}" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 group">
    @if($journey->hero_image)
        <div class="aspect-video bg-[var(--color-sand-beige)] overflow-hidden">
            <img src="{{ $journey->hero_image }}" alt="{{ $journey->title }}" loading="lazy" width="400" height="300" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>
    @else
        <div class="aspect-video bg-gradient-to-br from-[var(--color-sand-beige)] to-[var(--color-earth-brown)]"></div>
    @endif
    <div class="p-6">
        @if($journey->countries->count() > 0)
            <div class="mb-3">
                <span class="text-xs uppercase tracking-wide text-[var(--color-accent-gold)] font-semibold">
                    {{ $journey->countries->pluck('name')->join(', ') }}
                </span>
            </div>
        @endif
        <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3 group-hover:text-[var(--color-accent-gold)] transition-colors">
            {{ $journey->title }}
        </h3>
        <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed mb-4 line-clamp-2">
            {{ Str::limit($journey->narrative_intro, 120) }}
        </p>
        <span class="text-[var(--color-forest-green)] font-medium text-sm inline-flex items-center group-hover:text-[var(--color-accent-gold)] transition-colors">
            Explore Journey
            <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </span>
    </div>
</a>
