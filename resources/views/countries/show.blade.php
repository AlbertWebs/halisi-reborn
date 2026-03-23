@extends('layouts.app')

@section('title', $country->name . ' - Halisi Africa Discoveries')
@section('description', Str::limit($country->country_narrative, 160))
@push('structured_data')
<x-structured-data 
    type="breadcrumb" 
    :data="[
        'items' => [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Countries', 'url' => route('countries.index')],
            ['name' => $country->name, 'url' => route('countries.show', $country)],
        ]
    ]"
/>
@endpush
@push('styles')
<style>
    /* Country page: premium WOW-style reveal (scoped) */
    .country-wow.js-scroll {
        opacity: 0;
        transform: translateY(34px) scale(0.99);
        filter: blur(6px);
        transition:
            opacity 0.9s cubic-bezier(0.19, 1, 0.22, 1),
            transform 0.9s cubic-bezier(0.19, 1, 0.22, 1),
            filter 0.9s cubic-bezier(0.19, 1, 0.22, 1);
        will-change: opacity, transform, filter;
    }
    .country-wow.js-scroll.is-visible {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0);
    }
    .country-wow-delay-1 { transition-delay: 90ms !important; }
    .country-wow-delay-2 { transition-delay: 170ms !important; }
    .country-wow-delay-3 { transition-delay: 260ms !important; }

    .country-wow-group.js-scroll-stagger > * {
        opacity: 0;
        transform: translateY(28px) scale(0.992);
        filter: blur(4px);
        transition:
            opacity 0.78s cubic-bezier(0.19, 1, 0.22, 1),
            transform 0.78s cubic-bezier(0.19, 1, 0.22, 1),
            filter 0.78s cubic-bezier(0.19, 1, 0.22, 1);
    }
    .country-wow-group.js-scroll-stagger.is-visible > *:nth-child(1) { transition-delay: 0s; }
    .country-wow-group.js-scroll-stagger.is-visible > *:nth-child(2) { transition-delay: 0.08s; }
    .country-wow-group.js-scroll-stagger.is-visible > *:nth-child(3) { transition-delay: 0.16s; }
    .country-wow-group.js-scroll-stagger.is-visible > *:nth-child(4) { transition-delay: 0.24s; }
    .country-wow-group.js-scroll-stagger.is-visible > *:nth-child(5) { transition-delay: 0.32s; }
    .country-wow-group.js-scroll-stagger.is-visible > *:nth-child(6) { transition-delay: 0.4s; }
    .country-wow-group.js-scroll-stagger.is-visible > * {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0);
    }

    @media (prefers-reduced-motion: reduce) {
        .country-wow.js-scroll,
        .country-wow-group.js-scroll-stagger > * {
            opacity: 1 !important;
            transform: none !important;
            filter: none !important;
            transition: none !important;
        }
    }
</style>
@endpush

@section('content')
    @php
        // Extract Vimeo video ID from URL (support vimeo.com/123, vimeo.com/video/123, player.vimeo.com/video/123, or plain ID)
        $heroVideoId = null;
        if (filled($country->hero_video)) {
            if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $country->hero_video, $m)) {
                $heroVideoId = $m[1];
            } elseif (preg_match('/\/(\d+)(?:\?|$)/', $country->hero_video, $m)) {
                $heroVideoId = $m[1];
            } elseif (preg_match('/^\d+$/', trim($country->hero_video))) {
                $heroVideoId = trim($country->hero_video);
            }
        }
    @endphp

    <!-- Hero Section -->
    <section class="country-hero-section-wrapper {{ $heroVideoId ? 'country-hero-video-mode' : '' }} relative min-h-[80vh] flex items-end bg-[var(--color-forest-green)] text-white overflow-hidden">
        @if($heroVideoId)
            <!-- Video Background -->
            <div class="country-hero-video-container absolute inset-0 z-0">
                <div class="absolute inset-0 overflow-hidden">
                    <iframe 
                        src="https://player.vimeo.com/video/{{ $heroVideoId }}?background=1&autoplay=1&loop=1&muted=1&controls=0&playsinline=1&byline=0&title=0"
                        frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen
                        class="country-hero-vimeo-iframe"
                        style="position: absolute !important; top: 50% !important; left: 50% !important; width: 177.78vh !important; min-width: 100% !important; height: 100% !important; min-height: 56.25vw !important; transform: translate(-50%, -50%) !important; border: 0 !important; pointer-events: none !important;"
                    ></iframe>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>
            </div>
        @elseif($country->hero_image)
            <!-- Image Background -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('storage/' . $country->hero_image) }}" alt="{{ $country->name }}" loading="eager" fetchpriority="high" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>
            </div>
        @else
            <!-- Gradient Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)] z-0">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
            </div>
        @endif
        
        <div class="country-hero-content relative z-20 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="max-w-4xl">
                <h1 class="country-wow js-scroll text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                    {{ $country->name }}
                </h1>
                <div class="country-wow country-wow-delay-1 js-scroll prose prose-lg max-w-none text-gray-100">
                    <p class="text-xl leading-relaxed">
                        {{ $country->hero_subtitle ?: Str::limit(strip_tags($country->country_narrative), 200) }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Narrative Introduction -->
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] js-scroll js-scroll-fade country-wow">
                    {!! $country->country_narrative !!}
                </div>
                @if($country->narrative_image)
                    <div class="relative h-[400px] lg:h-[500px] rounded-lg overflow-hidden shadow-xl js-scroll country-wow country-wow-delay-1">
                        <img src="{{ asset('storage/' . $country->narrative_image) }}" alt="{{ $country->name }}" class="w-full h-full object-cover">
                    </div>
                @elseif($country->hero_image && !$heroVideoId)
                    <div class="relative h-[400px] lg:h-[500px] rounded-lg overflow-hidden shadow-xl js-scroll country-wow country-wow-delay-1">
                        <img src="{{ asset('storage/' . $country->hero_image) }}" alt="{{ $country->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="relative h-[400px] lg:h-[500px] rounded-lg overflow-hidden shadow-xl bg-gradient-to-br from-[var(--color-forest-green)] to-[var(--color-earth-brown)] flex items-center justify-center js-scroll country-wow country-wow-delay-1">
                        <div class="text-center text-white p-8">
                            <svg class="w-24 h-24 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-lg font-medium">{{ $country->name }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

   

    <!-- Signature Experiences -->
    @if($country->signature_experiences)
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 js-scroll country-wow">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    {{ $country->signature_experiences_title ?: 'Signature Experiences' }}
                </h2>
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center js-scroll-stagger country-wow-group">
                <div class="bg-white p-8 lg:p-12 rounded-lg shadow-lg">
                    <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                        {!! $country->signature_experiences !!}
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @php
                        $cardLabels = [
                            1 => $country->signature_card_1_label ?: 'Wildlife Encounters',
                            2 => $country->signature_card_2_label ?: 'Cultural Immersion',
                            3 => $country->signature_card_3_label ?: 'Adventure Activities',
                            4 => $country->signature_card_4_label ?: 'Luxury Lodging',
                        ];
                        $cardGradients = [
                            1 => 'from-[var(--color-forest-green)] to-[var(--color-earth-brown)]',
                            2 => 'from-[var(--color-earth-brown)] to-[var(--color-accent-gold)]',
                            3 => 'from-[var(--color-accent-gold)] to-[var(--color-forest-green)]',
                            4 => 'from-[var(--color-forest-green)] to-[var(--color-accent-gold)]',
                        ];
                        $parseVimeoId = function ($url) {
                            if (!filled($url)) return null;
                            if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $m)) return $m[1];
                            if (preg_match('/\/(\d+)(?:\?|$)/', $url, $m)) return $m[1];
                            if (preg_match('/^\d+$/', trim($url))) return trim($url);
                            return null;
                        };
                    @endphp
                    @foreach([1, 2, 3, 4] as $i)
                        @php
                            $videoUrl = $country->{"signature_card_{$i}_video"};
                            $imagePath = $country->{"signature_card_{$i}_image"};
                            $vimeoId = $parseVimeoId($videoUrl);
                        @endphp
                        <div class="relative h-48 rounded-lg overflow-hidden shadow-md signature-card">
                            @if($vimeoId)
                                {{-- Fallback image (or gradient) shown until video is ready --}}
                                @if($imagePath)
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="" class="signature-card-fallback absolute inset-0 w-full h-full object-cover z-0" aria-hidden="true">
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br {{ $cardGradients[$i] }} opacity-90 z-0" aria-hidden="true"></div>
                                @endif
                                <div class="absolute inset-0 z-[5] signature-card-video-wrap">
                                    <iframe
                                        src="https://player.vimeo.com/video/{{ $vimeoId }}?background=1&autoplay=1&loop=1&muted=1&controls=0&playsinline=1&byline=0&title=0"
                                        frameborder="0"
                                        allow="autoplay; fullscreen; picture-in-picture"
                                        allowfullscreen
                                        class="absolute top-0 left-1/2 h-full w-[177.78%] min-w-full -translate-x-1/2 pointer-events-none signature-card-iframe"
                                    ></iframe>
                                </div>
                                <div class="signature-card-preloader absolute inset-0 z-[25] flex items-center justify-center bg-black/50 transition-opacity duration-300" aria-live="polite" aria-label="Loading video">
                                    <div class="signature-card-preloader-spinner w-10 h-10 border-2 border-white/35 border-t-white rounded-full animate-spin" aria-hidden="true"></div>
                                </div>
                            @elseif($imagePath)
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $cardLabels[$i] }}" class="absolute inset-0 w-full h-full object-cover z-0">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br {{ $cardGradients[$i] }} opacity-80 z-0"></div>
                            @endif
                            <div class="absolute inset-0 bg-black/40 z-10"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-white text-center p-4 z-20">
                                <p class="font-semibold">{{ $cardLabels[$i] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    @php
        $countryGuide = [
            'tanzania' => [
                'lead' => 'A country of vast plains, iconic wildlife corridors, and Indian Ocean islands framed by coral reefs and Swahili heritage.',
                'capital' => 'Dodoma',
                'currency' => 'Tanzanian Shilling',
                'languages' => 'Swahili and English',
                'airport' => 'Julius Nyerere (DAR), Kilimanjaro (JRO), Abeid Amani Karume (ZNZ)',
                'time_zone' => 'East Africa Time (UTC+3)',
                'best_for' => 'Great Migration, crater safaris, coast + island retreats',
                'ideal_trip_length' => '8-14 nights',
                'best_time' => 'Jun-Oct for dry season safaris; Jan-Mar for calving landscapes',
                'entry' => 'Visa and entry policy depend on nationality',
                'health' => 'Travel insurance and pre-travel health guidance recommended',
                'style' => 'Private fly-in circuits or overland combinations',
                'ecosystems' => 'Savanna plains, volcanic highlands, Rift Valley, coral islands',
                'climate_intro' => 'Tropical on the coast and islands, temperate in most parks, with hotter conditions between October and March.',
                'climate' => [
                    ['season' => 'Dec - Mar', 'note' => 'Hot dry season, strong beach conditions.'],
                    ['season' => 'Apr - May', 'note' => 'Long rains, lush landscapes, fewer crowds.'],
                    ['season' => 'Jun - Nov', 'note' => 'Cooler dry season, excellent safari viewing.'],
                ],
                'highlights' => [
                    ['title' => 'Mount Kilimanjaro', 'text' => 'Africa\'s highest peak at 5,895m, with distinct ecological zones as you ascend.'],
                    ['title' => 'Ngorongoro Crater', 'text' => 'A vast intact caldera and one of East Africa\'s richest wildlife habitats.'],
                    ['title' => 'Serengeti', 'text' => 'Predator-rich plains and the famed Great Migration corridors.'],
                    ['title' => 'Zanzibar Archipelago', 'text' => 'Spice routes, coral reefs, and a refined coast-and-safari pairing.'],
                ],
            ],
            'kenya' => [
                'lead' => 'From the Maasai Mara and Amboseli to the Indian Ocean coast, Kenya blends iconic safaris with deeply rooted cultural heritage.',
                'capital' => 'Nairobi',
                'currency' => 'Kenyan Shilling',
                'languages' => 'Swahili and English',
                'airport' => 'Jomo Kenyatta (NBO), Moi (MBA), Kisumu (KIS)',
                'time_zone' => 'East Africa Time (UTC+3)',
                'best_for' => 'Big-cat safaris, conservancy travel, coast extensions',
                'ideal_trip_length' => '7-12 nights',
                'best_time' => 'Jun-Oct for classic game viewing; Jan-Mar for warm dry travel',
                'entry' => 'Visa and entry policy depend on nationality',
                'health' => 'Travel insurance and pre-travel health guidance recommended',
                'style' => 'Conservancy-led safaris with optional beach finish',
                'ecosystems' => 'Savanna, highlands, lakes, and Indian Ocean coastline',
                'climate_intro' => 'Generally warm with regional variation by altitude; dry windows often deliver the best game concentration.',
                'climate' => [
                    ['season' => 'Jan - Mar', 'note' => 'Warm and mostly dry, ideal for mixed safari routes.'],
                    ['season' => 'Apr - May', 'note' => 'Long rains, dramatic skies, rich green landscapes.'],
                    ['season' => 'Jun - Oct', 'note' => 'Cooler dry season, prime for wildlife movement.'],
                ],
                'highlights' => [
                    ['title' => 'Maasai Mara', 'text' => 'Classic big-cat territory and migration crossings.'],
                    ['title' => 'Amboseli', 'text' => 'Elephant herds set beneath Kilimanjaro views.'],
                    ['title' => 'Laikipia', 'text' => 'Conservancy-led wilderness and strong community partnerships.'],
                    ['title' => 'Kenya Coast', 'text' => 'Swahili heritage, marine life, and restorative beach retreats.'],
                ],
            ],
        ];

        $slug = $country->slug;
        $guide = $countryGuide[$slug] ?? null;
        $defaultLead = Str::limit(strip_tags((string) ($country->country_narrative ?? '')), 280);
        $guideLead = filled($country->destination_brief_lead)
            ? $country->destination_brief_lead
            : ($guide['lead'] ?? ($defaultLead ?: ('A layered destination where wildlife, culture, and landscape meet in one remarkable journey through ' . $country->name . '.')));
        $guideClimateIntro = filled($country->destination_brief_climate_intro)
            ? $country->destination_brief_climate_intro
            : ($guide['climate_intro'] ?? 'Conditions vary by region and elevation; we tailor timing around your preferred experience and pace.');
        $guideClimate = [
            ['season' => $country->destination_brief_climate_1_season, 'note' => $country->destination_brief_climate_1_note],
            ['season' => $country->destination_brief_climate_2_season, 'note' => $country->destination_brief_climate_2_note],
            ['season' => $country->destination_brief_climate_3_season, 'note' => $country->destination_brief_climate_3_note],
        ];
        $guideClimate = array_values(array_filter($guideClimate, function ($item) {
            return filled($item['season']) || filled($item['note']);
        }));
        if (count($guideClimate) === 0) {
            $guideClimate = $guide['climate'] ?? [
            ['season' => 'Dry window', 'note' => 'Excellent for game viewing and overland movement.'],
            ['season' => 'Green window', 'note' => 'Richer landscapes and strong photographic contrast.'],
            ['season' => 'Shoulder period', 'note' => 'Balanced conditions with fewer travellers.'],
            ];
        }
        $dynamicHighlights = $country->highlights()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get(['title', 'text', 'image'])
            ->map(function ($item) {
                return [
                    'title' => $item->title,
                    'text' => $item->text,
                    'image' => $item->image,
                ];
            })
            ->all();
        $guideHighlights = $dynamicHighlights;
        if (count($guideHighlights) === 0) {
            $guideHighlights = [
                ['title' => $country->highlight_1_title, 'text' => $country->highlight_1_text, 'image' => $country->highlight_1_image],
                ['title' => $country->highlight_2_title, 'text' => $country->highlight_2_text, 'image' => $country->highlight_2_image],
                ['title' => $country->highlight_3_title, 'text' => $country->highlight_3_text, 'image' => $country->highlight_3_image],
                ['title' => $country->highlight_4_title, 'text' => $country->highlight_4_text, 'image' => $country->highlight_4_image],
            ];
        }
        $guideHighlights = array_values(array_filter($guideHighlights, function ($item) {
            return filled($item['title']) || filled($item['text']);
        }));
        if (count($guideHighlights) === 0) {
            $guideHighlights = $guide['highlights'] ?? [
            ['title' => 'Iconic wilderness', 'text' => 'Protected landscapes where biodiversity remains central to the experience.'],
            ['title' => 'Cultural depth', 'text' => 'Host-led encounters grounded in respect, context, and exchange.'],
            ['title' => 'Conservation models', 'text' => 'Journeys linked to long-term habitat and community outcomes.'],
            ['title' => 'Refined stays', 'text' => 'Properties selected for character, comfort, and place-based design.'],
            ];
        }
        $guideEssentials = [
            'Capital' => $country->destination_brief_capital ?: ($guide['capital'] ?? 'Available on request'),
            'Currency' => $country->destination_brief_currency ?: ($guide['currency'] ?? 'Varies by region'),
            'Languages' => $country->destination_brief_languages ?: ($guide['languages'] ?? 'English and local languages'),
            'Time zone' => $country->destination_brief_time_zone ?: ($guide['time_zone'] ?? 'East Africa Time (UTC+3)'),
            'Main airports' => $country->destination_brief_airports ?: ($guide['airport'] ?? 'Primary international gateway + regional airstrips'),
            'Best for' => $country->destination_brief_best_for ?: ($guide['best_for'] ?? 'Wildlife, culture, and conservation-led travel'),
            'Ideal trip length' => $country->destination_brief_ideal_trip_length ?: ($guide['ideal_trip_length'] ?? '7-12 nights'),
            'Best time to visit' => $country->destination_brief_best_time ?: ($guide['best_time'] ?? 'Planned around your route and preferred experiences'),
            'Travel style' => $country->destination_brief_travel_style ?: ($guide['style'] ?? 'Private, tailored journeys'),
            'Ecosystems' => $country->destination_brief_ecosystems ?: ($guide['ecosystems'] ?? 'Mixed habitats and protected landscapes'),
            'Entry requirements' => $country->destination_brief_entry_requirements ?: ($guide['entry'] ?? 'Check latest rules for your passport before departure'),
            'Health notes' => $country->destination_brief_health_notes ?: ($guide['health'] ?? 'Travel insurance and pre-travel health guidance recommended'),
        ];
        $resolveCountryImage = function (?string $image): ?string {
            if (!filled($image)) {
                return null;
            }
            if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
                return $image;
            }
            if (str_starts_with($image, '/storage/')) {
                return asset(ltrim($image, '/'));
            }
            if (str_starts_with($image, 'storage/')) {
                return asset($image);
            }
            return asset('storage/' . ltrim($image, '/'));
        };
        $decodeEntitiesRepeatedly = function (?string $value): string {
            $decoded = (string) $value;
            for ($i = 0; $i < 3; $i++) {
                $next = html_entity_decode($decoded, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                if ($next === $decoded) {
                    break;
                }
                $decoded = $next;
            }
            return $decoded;
        };
        $highlightImages = array_values(array_filter([
            $resolveCountryImage($country->highlight_1_image),
            $resolveCountryImage($country->highlight_2_image),
            $resolveCountryImage($country->highlight_3_image),
            $resolveCountryImage($country->highlight_4_image),
            $resolveCountryImage($country->signature_card_1_image),
            $resolveCountryImage($country->signature_card_2_image),
            $resolveCountryImage($country->signature_card_3_image),
            $resolveCountryImage($country->signature_card_4_image),
            $resolveCountryImage($country->narrative_image),
            $resolveCountryImage($country->conservation_image),
            $resolveCountryImage($country->hero_image),
        ]));
    @endphp

    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-stretch">
                <div class="lg:col-span-7 js-scroll country-wow h-full flex flex-col">
                    <p class="text-xs uppercase tracking-[0.2em] text-[var(--color-accent-gold)] font-semibold mb-3">Destination brief</p>
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-5">
                        {{ $country->name }}: Legends and landscapes
                    </h2>
                    <p class="text-lg text-[var(--color-earth-brown)] leading-relaxed mb-6">
                        {{ $guideLead }}
                    </p>
                    <div class="rounded-2xl border border-[var(--color-sand-beige)]/85 bg-[var(--color-off-white)] p-6 md:p-7 shadow-sm mt-auto">
                        <h3 class="text-base md:text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-3">Climate</h3>
                        <p class="text-sm md:text-base text-[var(--color-earth-brown)] leading-relaxed mb-4">{{ $guideClimateIntro }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @foreach($guideClimate as $slice)
                                <div class="rounded-xl border border-[var(--color-sand-beige)] bg-white p-4">
                                    <p class="text-xs uppercase tracking-[0.14em] text-[var(--color-accent-gold)] font-semibold mb-1">{{ $slice['season'] }}</p>
                                    <p class="text-sm text-[var(--color-earth-brown)] leading-snug">{{ $slice['note'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 js-scroll country-wow country-wow-delay-1 h-full">
                    <div class="rounded-2xl overflow-hidden border border-[var(--color-sand-beige)]/80 shadow-[0_16px_40px_rgba(26,77,58,0.08)] bg-white h-full">
                        <div class="px-6 py-5 border-b border-[var(--color-sand-beige)]/70 bg-[var(--color-off-white)]">
                            <p class="text-xs uppercase tracking-[0.16em] text-[var(--color-accent-gold)] font-semibold">Country essentials</p>
                        </div>
                        <dl class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                            @foreach($guideEssentials as $label => $value)
                                <div class="flex flex-col gap-1">
                                    <dt class="text-[0.68rem] uppercase tracking-[0.14em] text-[var(--color-forest-green)]/75 font-semibold">{{ $label }}</dt>
                                    <dd class="text-sm text-[var(--color-earth-brown)] leading-snug">{{ $value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>

            <div class="mt-14 md:mt-16 rounded-2xl border border-[var(--color-sand-beige)]/80 bg-white px-4 py-7 md:px-7 md:py-9 lg:px-8 lg:py-10 shadow-[0_14px_34px_rgba(26,77,58,0.08)]">
                <header class="mb-7 md:mb-8 js-scroll country-wow">
                    <p class="text-[0.68rem] uppercase tracking-[0.16em] text-[var(--color-accent-gold)] font-semibold mb-2">Signature places</p>
                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-serif font-bold text-[var(--color-forest-green)]">
                        {{ $country->highlights_title ?: 'Highlights' }}
                    </h3>
                    <div class="w-16 h-0.5 bg-[var(--color-accent-gold)] mt-4 mb-3"></div>
                    <p class="text-sm md:text-base text-[var(--color-earth-brown)] leading-relaxed max-w-3xl">
                        Places that define {{ $country->name }} and the rhythm of each journey.
                    </p>
                </header>
                <div class="space-y-5 md:space-y-6">
                    @foreach($guideHighlights as $idx => $item)
                        @php
                            $itemImage = $resolveCountryImage($item['image'] ?? null);
                            $image = $itemImage ?: ($highlightImages[$idx] ?? $highlightImages[0] ?? null);
                            $isEven = $idx % 2 === 1;
                            $highlightTextRaw = $decodeEntitiesRepeatedly($item['text'] ?? '');
                            $highlightTextHtml = preg_match('/<[a-z][\s\S]*>/i', trim($highlightTextRaw))
                                ? $highlightTextRaw
                                : nl2br(e($highlightTextRaw));
                        @endphp
                        <article class="grid grid-cols-1 md:grid-cols-12 overflow-hidden border border-[var(--color-sand-beige)]/85 bg-white js-scroll country-wow md:min-h-[390px] shadow-[0_10px_26px_rgba(26,77,58,0.07)]">
                            <div class="relative p-7 md:p-8 lg:p-10 flex flex-col justify-center bg-[var(--color-off-white)] md:col-span-6 {{ $isEven ? 'md:order-2' : '' }}">
                                <div class="absolute left-0 top-0 h-full w-1 bg-[var(--color-accent-gold)]" aria-hidden="true"></div>
                                <div class="max-w-xl">
                                    <div class="inline-flex items-center gap-2 mb-3">
                                        <span class="inline-flex items-center justify-center min-w-7 h-7 px-2 rounded-sm bg-[var(--color-forest-green)] text-white text-[0.68rem] font-semibold">
                                            {{ str_pad((string) ($idx + 1), 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                        <span class="text-[0.64rem] uppercase tracking-[0.14em] text-[var(--color-forest-green)]/75 font-semibold">Signature place</span>
                                    </div>
                                    <h4 class="text-2xl md:text-3xl font-serif font-semibold text-[var(--color-forest-green)] leading-tight">
                                        {{ $item['title'] }}
                                    </h4>
                                    <div class="text-[0.95rem] md:text-base text-[var(--color-earth-brown)]/90 leading-relaxed mt-4 prose prose-sm max-w-none">
                                        {!! $highlightTextHtml !!}
                                    </div>
                                </div>
                            </div>
                            <div class="relative h-[230px] md:h-full md:min-h-[390px] md:col-span-6 {{ $isEven ? 'md:order-1' : '' }}">
                                @if($image)
                                    <img src="{{ $image }}" alt="{{ $item['title'] }} in {{ $country->name }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover">
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-accent-gold)]"></div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-black/10 to-transparent"></div>
                                <div class="absolute inset-0 ring-1 ring-inset ring-white/25"></div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @php
        $ctaVideoFiles = \Illuminate\Support\Facades\File::glob(public_path('uploads/videos/*.{mp4,webm,mov,m4v}'), GLOB_BRACE) ?: [];
        $ctaVideoPath = null;
        if (!empty($ctaVideoFiles)) {
            foreach ($ctaVideoFiles as $videoFile) {
                if (\Illuminate\Support\Str::contains(strtolower(basename($videoFile)), strtolower($country->slug))) {
                    $ctaVideoPath = $videoFile;
                    break;
                }
            }
            $ctaVideoPath = $ctaVideoPath ?: $ctaVideoFiles[0];
        }
        $ctaVideoUrl = $ctaVideoPath ? asset('uploads/videos/' . basename($ctaVideoPath)) : null;
    @endphp

    <!-- CTA Block (matched to Responsible page Start Planning card) -->
    <section class="relative section-padding-lg overflow-hidden bg-gradient-to-b from-[var(--color-forest-green)] via-[#174030] to-[#0f241c] text-white">
        @if($ctaVideoUrl)
            <video
                class="absolute inset-0 w-full h-full object-cover"
                autoplay
                muted
                loop
                playsinline
                preload="metadata"
                aria-hidden="true"
            >
                <source src="{{ $ctaVideoUrl }}" type="video/{{ pathinfo($ctaVideoUrl, PATHINFO_EXTENSION) }}">
            </video>
            <div class="absolute inset-0 bg-black/55" aria-hidden="true"></div>
        @endif
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_0%,rgba(212,175,55,0.12),transparent_60%)]" aria-hidden="true"></div>
        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-white/15 bg-white/[0.06] backdrop-blur-sm p-8 md:p-12 lg:p-14 text-center shadow-[0_28px_90px_rgba(0,0,0,0.35)]">
                <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-4 js-scroll country-wow">Start planning</p>
                <h2 class="text-3xl sm:text-4xl md:text-[2.75rem] font-serif font-bold mb-6 js-scroll country-wow text-balance leading-tight">
                    {{ $country->cta_title ?: ('Explore ' . $country->name . ' Journeys') }}
                </h2>
                @if($country->cta_description)
                    <p class="text-base md:text-lg text-white/85 max-w-2xl mx-auto mb-10 js-scroll country-wow country-wow-delay-1 leading-relaxed">
                        {{ $country->cta_description }}
                    </p>
                @else
                    <p class="text-base md:text-lg text-white/85 max-w-2xl mx-auto mb-10 js-scroll country-wow country-wow-delay-1 leading-relaxed">
                        Let us design a bespoke journey in {{ $country->name }} tailored to your interests, travel style, and pace.
                    </p>
                @endif
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 js-scroll country-wow country-wow-delay-2">
                    <x-button-primary href="{{ $country->cta_link ?: route('contact.index', ['country' => $country->slug]) }}" title="Plan your {{ $country->name }} journey" class="!bg-white !text-[var(--color-forest-green)] hover:!bg-gray-100 !border-[var(--color-forest-green)]/25 px-10 py-4 text-base shadow-lg">
                        {{ $country->cta_button_text ?: 'Design Your Journey' }}
                    </x-button-primary>
                    <x-button-secondary href="{{ route('journeys.index') }}" class="border-white/90 text-white hover:bg-white hover:text-[var(--color-forest-green)] px-10 py-4 text-base">
                        Explore journeys
                    </x-button-secondary>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Journeys -->
    @if($journeys->count() > 0)
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8 text-center js-scroll country-wow">
                {{ $country->featured_journeys_title ?: 'Featured Journeys in ' . $country->name }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 js-scroll-stagger country-wow-group">
                @foreach($journeys as $journey)
                    <x-journey-card :journey="$journey" />
                @endforeach
            </div>
            
            <div class="mt-12 text-center">
                <x-button-primary href="{{ route('journeys.index') }}">
                    {{ $country->featured_journeys_button_text ?: 'View All Journeys' }}
                </x-button-primary>
            </div>
        </div>
    </section>

    
    @endif

    <script>
        document.querySelectorAll('.signature-card').forEach(function (card) {
            var iframe = card.querySelector('.signature-card-iframe');
            var preloader = card.querySelector('.signature-card-preloader');
            if (!iframe || !preloader) return;
            function hidePreloader() {
                preloader.classList.add('opacity-0', 'pointer-events-none');
                setTimeout(function () { preloader.classList.add('invisible'); }, 350);
            }
            iframe.addEventListener('load', hidePreloader, { once: true });
            window.setTimeout(hidePreloader, 6000);
        });
    </script>

    <style>
        @media (max-width: 767px) {
            /* On mobile country pages with hero video, match section height to video frame */
            .country-hero-video-mode {
                min-height: 56.25vw !important; /* 16:9 */
                height: 56.25vw !important;
            }

            .country-hero-video-mode .country-hero-content {
                padding-bottom: 1.25rem !important;
            }

            /* Keep mobile typography proportional across the country page */
            .country-hero-section-wrapper h1 {
                font-size: 1.8rem !important;
                line-height: 1.15 !important;
                margin-bottom: 0.65rem !important;
            }

            .country-hero-section-wrapper .prose p,
            .country-hero-section-wrapper p {
                font-size: 0.95rem !important;
                line-height: 1.35 !important;
            }

            .country-hero-content {
                padding-bottom: 0.9rem !important;
            }

            .country-hero-content .max-w-4xl {
                max-width: 92% !important;
            }

            section.section-padding h2 {
                font-size: 1.6rem !important;
                line-height: 1.2 !important;
            }

            section.section-padding h3 {
                font-size: 1.1rem !important;
                line-height: 1.25 !important;
            }

            section.section-padding .prose,
            section.section-padding p,
            section.section-padding li {
                font-size: 0.95rem !important;
                line-height: 1.6 !important;
            }
        }
    </style>
@endsection
