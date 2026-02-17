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
    <!-- Hero Section -->
    <section class="country-hero-section-wrapper relative min-h-[80vh] flex items-end bg-[var(--color-forest-green)] text-white overflow-hidden">
        @if($country->hero_video)
            <!-- Video Background -->
            <div class="country-hero-video-container absolute inset-0 z-0">
                @php
                    // Extract Vimeo video ID from URL
                    $videoId = null;
                    if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $country->hero_video, $matches)) {
                        $videoId = $matches[1];
                    } elseif (preg_match('/\/(\d+)/', $country->hero_video, $matches)) {
                        $videoId = $matches[1];
                    }
                @endphp
                @if($videoId)
                    <iframe 
                        src="https://player.vimeo.com/video/{{ $videoId }}?background=1&autoplay=1&loop=1&muted=1&controls=0&playsinline=1&byline=0&title=0"
                        frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture"
                        class="absolute inset-0 w-full h-full object-cover"
                    ></iframe>
                @endif
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
        
        <div class="relative z-20 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
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
                <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                    {!! $country->country_narrative !!}
                </div>
                @if($country->narrative_image)
                    <div class="relative h-[400px] lg:h-[500px] rounded-lg overflow-hidden shadow-xl">
                        <img src="{{ asset('storage/' . $country->narrative_image) }}" alt="{{ $country->name }}" class="w-full h-full object-cover">
                    </div>
                @elseif($country->hero_image && !$country->hero_video)
                    <div class="relative h-[400px] lg:h-[500px] rounded-lg overflow-hidden shadow-xl">
                        <img src="{{ asset('storage/' . $country->hero_image) }}" alt="{{ $country->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="relative h-[400px] lg:h-[500px] rounded-lg overflow-hidden shadow-xl bg-gradient-to-br from-[var(--color-forest-green)] to-[var(--color-earth-brown)] flex items-center justify-center">
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
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    {{ $country->signature_experiences_title ?: 'Signature Experiences' }}
                </h2>
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="bg-white p-8 lg:p-12 rounded-lg shadow-lg">
                    <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                        {!! $country->signature_experiences !!}
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative h-48 rounded-lg overflow-hidden shadow-md">
                        <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-forest-green)] to-[var(--color-earth-brown)] opacity-80"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-white text-center p-4">
                            <p class="font-semibold">Wildlife Encounters</p>
                        </div>
                    </div>
                    <div class="relative h-48 rounded-lg overflow-hidden shadow-md">
                        <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-earth-brown)] to-[var(--color-accent-gold)] opacity-80"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-white text-center p-4">
                            <p class="font-semibold">Cultural Immersion</p>
                        </div>
                    </div>
                    <div class="relative h-48 rounded-lg overflow-hidden shadow-md">
                        <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-accent-gold)] to-[var(--color-forest-green)] opacity-80"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-white text-center p-4">
                            <p class="font-semibold">Adventure Activities</p>
                        </div>
                    </div>
                    <div class="relative h-48 rounded-lg overflow-hidden shadow-md">
                        <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-forest-green)] to-[var(--color-accent-gold)] opacity-80"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-white text-center p-4">
                            <p class="font-semibold">Luxury Lodging</p>
                        </div>
                    </div>
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
                    <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-accent-gold)] opacity-90"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-white p-8">
                        <div class="text-center">
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
                        <x-button-secondary href="{{ route('impact.responsible-travel') }}">
                            Learn About Our Impact Approach
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
@endsection
