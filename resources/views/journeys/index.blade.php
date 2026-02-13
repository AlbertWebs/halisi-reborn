@extends('layouts.app')

@section('title', 'Journeys - Halisi Africa Discoveries')
@section('description', 'Explore our collection of authentic African journeys designed to regenerate ecosystems and empower communities.')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[60vh] flex items-center justify-center bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                Our Journeys
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-2xl mx-auto">
                Authentic African experiences designed to regenerate ecosystems and empower communities
            </p>
        </div>
    </section>

    <!-- Category Navigation -->
    <section class="section-padding bg-white border-b border-[var(--color-sand-beige)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('journeys.signature-safaris') }}" class="px-6 py-3 bg-[var(--color-off-white)] text-[var(--color-forest-green)] rounded-lg hover:bg-[var(--color-sand-beige)] transition-colors font-medium">
                    Signature Safaris
                </a>
                <a href="{{ route('journeys.bespoke-private') }}" class="px-6 py-3 bg-[var(--color-off-white)] text-[var(--color-forest-green)] rounded-lg hover:bg-[var(--color-sand-beige)] transition-colors font-medium">
                    Bespoke Private Travel
                </a>
                <a href="{{ route('journeys.conservation-community') }}" class="px-6 py-3 bg-[var(--color-off-white)] text-[var(--color-forest-green)] rounded-lg hover:bg-[var(--color-sand-beige)] transition-colors font-medium">
                    Conservation & Community
                </a>
                <a href="{{ route('journeys.luxury-retreats') }}" class="px-6 py-3 bg-[var(--color-off-white)] text-[var(--color-forest-green)] rounded-lg hover:bg-[var(--color-sand-beige)] transition-colors font-medium">
                    Luxury Retreats
                </a>
            </div>
        </div>
    </section>

    <!-- Journey Grid -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($journeys->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($journeys as $journey)
                        <x-journey-card :journey="$journey" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <p class="text-lg text-[var(--color-earth-brown)] mb-6">
                        Journeys are coming soon. Contact us to design a bespoke journey tailored to your interests.
                    </p>
                    <x-button-primary href="{{ route('contact.index') }}">
                        Design Your Journey
                    </x-button-primary>
                </div>
            @endif
        </div>
    </section>
@endsection
