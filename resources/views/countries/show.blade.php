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
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                    {{ $country->name }}
                </h1>
                <div class="prose prose-lg max-w-none text-gray-100">
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
                <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] js-scroll js-scroll-fade">
                    {!! $country->country_narrative !!}
                </div>
                @if($country->narrative_image)
                    <div class="relative h-[400px] lg:h-[500px] rounded-lg overflow-hidden shadow-xl js-scroll">
                        <img src="{{ asset('storage/' . $country->narrative_image) }}" alt="{{ $country->name }}" class="w-full h-full object-cover">
                    </div>
                @elseif($country->hero_image && !$heroVideoId)
                    <div class="relative h-[400px] lg:h-[500px] rounded-lg overflow-hidden shadow-xl js-scroll">
                        <img src="{{ asset('storage/' . $country->hero_image) }}" alt="{{ $country->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="relative h-[400px] lg:h-[500px] rounded-lg overflow-hidden shadow-xl bg-gradient-to-br from-[var(--color-forest-green)] to-[var(--color-earth-brown)] flex items-center justify-center js-scroll">
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
            <div class="text-center mb-12 js-scroll">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    {{ $country->signature_experiences_title ?: 'Signature Experiences' }}
                </h2>
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center js-scroll-stagger">
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

    <!-- Conservation & Community Focus -->
    @if($country->conservation_focus)
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative h-[500px] rounded-lg overflow-hidden shadow-xl order-2 lg:order-1">
                    @if($country->conservation_image)
                        <img src="{{ asset('storage/' . $country->conservation_image) }}" alt="{{ $country->conservation_title ?: 'Conservation & Community Focus' }}" class="absolute inset-0 w-full h-full object-cover z-0">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10"></div>
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-accent-gold)] opacity-90 z-0"></div>
                    @endif
                    <div class="absolute inset-0 flex items-center justify-center text-white p-8 z-20">
                        <div class="text-center">
                            @if($country->conservation_image)
                                <div class="absolute bottom-0 left-0 right-0 p-8 text-left">
                                    @if($country->conservation_visual_text)
                                        <div class="prose prose-lg max-w-none text-white prose-headings:text-white prose-p:text-white">
                                            {!! $country->conservation_visual_text !!}
                                        </div>
                                    @else
                                        <h3 class="text-2xl font-serif font-bold mb-2">Our Commitment</h3>
                                        <p class="text-lg text-white/95">Supporting local communities and conservation efforts across {{ $country->name }}</p>
                                    @endif
                                </div>
                            @else
                                <svg class="w-20 h-20 mx-auto mb-4 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @if($country->conservation_visual_text)
                                    <div class="prose prose-lg max-w-none text-white">
                                        {!! $country->conservation_visual_text !!}
                                    </div>
                                @else
                                    <h3 class="text-2xl font-serif font-bold mb-2">Our Commitment</h3>
                                    <p class="text-lg">Supporting local communities and conservation efforts across {{ $country->name }}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="mb-8">
                        <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                            {{ $country->conservation_title ?: 'Conservation & Community Focus' }}
                        </h2>
                    </div>
                    
                    <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                        {!! $country->conservation_focus !!}
                    </div>
                    
                    <div class="mt-8">
                        <x-button-secondary href="{{ $country->conservation_button_link ?: route('impact.responsible-travel') }}">
                            {{ $country->conservation_button_text ?: 'Learn About Our Impact Approach' }}
                        </x-button-secondary>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Featured Journeys -->
    @if($journeys->count() > 0)
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8 text-center">
                {{ $country->featured_journeys_title ?: 'Featured Journeys in ' . $country->name }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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

    <!-- CTA Block -->
    <section class="section-padding bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">
                {{ $country->cta_title ?: 'Explore ' . $country->name . ' Journeys' }}
            </h2>
            @if($country->cta_description)
                <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                    {{ $country->cta_description }}
                </p>
            @else
                <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                    Let us design a bespoke journey in {{ $country->name }} tailored to your interests and travel style.
                </p>
            @endif
            <a href="{{ $country->cta_link ?: route('contact.index', ['country' => $country->slug]) }}" class="inline-block px-10 py-5 bg-white text-[var(--color-forest-green)] font-semibold uppercase tracking-wide hover:bg-gray-100 hover:text-[var(--color-forest-green)] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[var(--color-forest-green)] transition-colors text-lg border-0">
                {{ $country->cta_button_text ?: 'Design Your Journey' }}
            </a>
        </div>
    </section>

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
