@extends('layouts.app')

@section('title', 'Journeys - Halisi Africa Discoveries')
@section('description', 'Explore our collection of authentic African journeys designed to regenerate ecosystems and empower communities.')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[70vh] flex items-center justify-center bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)] text-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent z-0"></div>
        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-6">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif font-bold mb-6 text-balance leading-tight">
                Our Journeys
            </h1>
            <p class="text-xl md:text-2xl lg:text-3xl text-gray-100 max-w-3xl mx-auto mb-8 leading-relaxed">
                Authentic African experiences designed to regenerate ecosystems and empower communities
            </p>
            <div class="flex flex-row gap-2 sm:gap-4 justify-center flex-wrap">
                <a href="{{ route('contact.index') }}" class="inline-block px-4 sm:px-8 py-3 sm:py-4 bg-white text-[var(--color-forest-green)] font-semibold uppercase tracking-wide hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[var(--color-forest-green)] transition-colors text-sm sm:text-lg shadow-lg hover:shadow-xl whitespace-nowrap">
                    Design Your Journey
                </a>
                <a href="#journeys" class="inline-block px-4 sm:px-8 py-3 sm:py-4 bg-transparent text-white border-2 border-white font-semibold uppercase tracking-wide hover:bg-white hover:text-[var(--color-forest-green)] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[var(--color-forest-green)] transition-colors text-sm sm:text-lg whitespace-nowrap">
                    Explore Journeys
                </a>
            </div>
        </div>
    </section>

    <!-- Category Navigation -->
    <section class="section-padding bg-white border-b border-[var(--color-sand-beige)] sticky top-16 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-3 md:gap-4">
                <a href="{{ route('journeys.index') }}" class="px-6 py-3 {{ request()->routeIs('journeys.index') ? 'bg-[var(--color-forest-green)] text-white' : 'bg-[var(--color-off-white)] text-[var(--color-forest-green)] hover:bg-[var(--color-sand-beige)]' }} rounded-lg transition-all duration-300 font-medium text-sm md:text-base shadow-sm hover:shadow-md">
                    All Journeys
                </a>
                <a href="{{ route('journeys.signature-safaris') }}" class="px-6 py-3 {{ request()->routeIs('journeys.signature-safaris') ? 'bg-[var(--color-forest-green)] text-white' : 'bg-[var(--color-off-white)] text-[var(--color-forest-green)] hover:bg-[var(--color-sand-beige)]' }} rounded-lg transition-all duration-300 font-medium text-sm md:text-base shadow-sm hover:shadow-md">
                    Signature Safaris
                </a>
                <a href="{{ route('journeys.bespoke-private') }}" class="px-6 py-3 {{ request()->routeIs('journeys.bespoke-private') ? 'bg-[var(--color-forest-green)] text-white' : 'bg-[var(--color-off-white)] text-[var(--color-forest-green)] hover:bg-[var(--color-sand-beige)]' }} rounded-lg transition-all duration-300 font-medium text-sm md:text-base shadow-sm hover:shadow-md">
                    Bespoke Private Travel
                </a>
                <a href="{{ route('journeys.conservation-community') }}" class="px-6 py-3 {{ request()->routeIs('journeys.conservation-community') ? 'bg-[var(--color-forest-green)] text-white' : 'bg-[var(--color-off-white)] text-[var(--color-forest-green)] hover:bg-[var(--color-sand-beige)]' }} rounded-lg transition-all duration-300 font-medium text-sm md:text-base shadow-sm hover:shadow-md">
                    Conservation & Community
                </a>
                <a href="{{ route('journeys.luxury-retreats') }}" class="px-6 py-3 {{ request()->routeIs('journeys.luxury-retreats') ? 'bg-[var(--color-forest-green)] text-white' : 'bg-[var(--color-off-white)] text-[var(--color-forest-green)] hover:bg-[var(--color-sand-beige)]' }} rounded-lg transition-all duration-300 font-medium text-sm md:text-base shadow-sm hover:shadow-md">
                    Luxury Retreats
                </a>
            </div>
        </div>
    </section>

    <!-- Journey Grid -->
    <section id="journeys" class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($journeys->count() > 0)
                <div class="mb-12 text-center js-scroll">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                        {{ request()->routeIs('journeys.index') ? 'All Journeys' : 'Featured Journeys' }}
                    </h2>
                    <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-4"></div>
                    <p class="text-lg text-[var(--color-earth-brown)] max-w-2xl mx-auto">
                        Discover our curated collection of transformative African experiences
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 js-scroll-stagger">
                    @foreach($journeys as $journey)
                        <x-journey-card :journey="$journey" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <div class="max-w-2xl mx-auto">
                        <svg class="w-24 h-24 mx-auto mb-6 text-[var(--color-forest-green)] opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-2xl md:text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                            Journeys Coming Soon
                        </h3>
                        <p class="text-lg text-[var(--color-earth-brown)] mb-8 leading-relaxed">
                            We're curating exceptional African experiences for you. Contact us to design a bespoke journey tailored to your interests and travel style.
                        </p>
                        <x-button-primary href="{{ route('contact.index') }}" class="text-lg px-8 py-4">
                            Design Your Journey
                        </x-button-primary>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-padding bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center js-scroll">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">
                Ready to Begin Your Journey?
            </h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto leading-relaxed">
                Let us design a bespoke African experience tailored to your interests, travel style, and conservation values.
            </p>
            <div class="flex flex-row gap-2 sm:gap-4 justify-center flex-wrap">
                <a href="{{ route('contact.index') }}" class="inline-block px-4 sm:px-10 py-3 sm:py-5 bg-white text-[var(--color-forest-green)] font-semibold uppercase tracking-wide hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[var(--color-forest-green)] transition-colors text-sm sm:text-lg shadow-lg hover:shadow-xl whitespace-nowrap">
                    Start Planning
                </a>
                <a href="{{ route('countries.index') }}" class="inline-block px-4 sm:px-10 py-3 sm:py-5 bg-transparent text-white border-2 border-white font-semibold uppercase tracking-wide hover:bg-white hover:text-[var(--color-forest-green)] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[var(--color-forest-green)] transition-colors text-sm sm:text-lg whitespace-nowrap">
                    Explore Countries
                </a>
            </div>
        </div>
    </section>
@endsection
