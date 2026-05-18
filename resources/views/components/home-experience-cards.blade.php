@php
    $experienceCards = [
        ['title' => 'Bespoke Safaris', 'stock_key' => 'safaris', 'route' => route('journeys.signature-safaris'), 'btn' => 'View Safaris', 'alt' => 'Wildlife on safari in Africa'],
        ['title' => 'Luxury Escapes', 'stock_key' => 'luxury', 'route' => route('journeys.luxury-retreats'), 'btn' => 'View Escapes', 'alt' => 'Luxury travel and dining in Africa'],
        ['title' => 'Conservation & Community', 'stock_key' => 'community', 'route' => route('journeys.conservation-community'), 'btn' => 'View Impact Journeys', 'alt' => 'Conservation and community impact travel'],
        ['title' => 'Bespoke Private Travel', 'stock_key' => 'private', 'route' => route('journeys.bespoke-private'), 'btn' => 'View Private Travel', 'alt' => 'Private bespoke travel across Africa'],
    ];
    $el = 'd' . 'iv';
@endphp

<{{ $el }} class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8 lg:gap-10 experience-grid items-stretch js-scroll-stagger">
    @foreach($experienceCards as $card)
        <{{ $el }} class="experience-card experience-card--luxury overflow-hidden rounded-2xl">
            @if($img = \App\Support\StockImage::url('homepage.experiences.' . $card['stock_key']))
                <img
                    src="{{ $img }}"
                    alt="{{ $card['alt'] }}"
                    class="experience-image"
                    width="640"
                    height="800"
                    loading="lazy"
                    decoding="async"
                >
            @endif
            <{{ $el }} class="experience-card-overlay" aria-hidden="true"></{{ $el }}>
            <{{ $el }} class="experience-content">
                <h3 class="experience-title text-base sm:text-xl lg:text-2xl font-serif font-semibold">{{ $card['title'] }}</h3>
                <{{ $el }}>
                    <x-button-secondary href="{{ $card['route'] }}" class="experience-card-btn border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent text-sm px-4 py-2">
                        {{ $card['btn'] }}
                    </x-button-secondary>
                </{{ $el }}>
            </{{ $el }}>
        </{{ $el }}>
    @endforeach
</{{ $el }}>
