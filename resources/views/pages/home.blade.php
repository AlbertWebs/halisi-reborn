@extends('layouts.app')

@section('title', 'Halisi Africa Discoveries - Authentic African Journeys')
@section('description', 'Authentic African Journeys, Designed to Regenerate')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-[var(--color-forest-green)] text-white py-20 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6">
                    Authentic African Journeys, Designed to Regenerate
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-200 max-w-3xl mx-auto">
                    Luxury travel across Africa, rooted in conservation and community.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <x-button-primary href="{{ route('contact.index') }}" class="text-lg">
                        Design Your Journey
                    </x-button-primary>
                    <x-button-secondary href="{{ route('about') }}" class="text-lg bg-white text-[var(--color-forest-green)] border-white hover:bg-gray-100">
                        Learn More
                    </x-button-secondary>
                </div>
            </div>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                Welcome to Halisi Africa Discoveries
            </h2>
            <p class="text-lg text-[var(--color-earth-brown)] leading-relaxed">
                Crafting bespoke, luxury experiences across Africa—with purpose and impact.
            </p>
        </div>
    </section>

    <x-section-divider />

    <!-- Our Experiences Section -->
    <section class="py-16 bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-serif font-bold text-center text-[var(--color-forest-green)] mb-12">
                Our Experiences
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-pillar-card 
                    title="Bespoke Safaris" 
                    description="Immersive wildlife experiences in pristine wilderness areas, guided by expert naturalists who share deep knowledge of ecosystems and conservation."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.signature-safaris') }}" class="mt-4">
                            Explore
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    title="Luxury Escapes" 
                    description="Bespoke accommodations and curated experiences that blend comfort with authenticity, ensuring every moment reflects the spirit of Africa."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.luxury-retreats') }}" class="mt-4">
                            Explore
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    title="Conservation & Community" 
                    description="Journeys that directly support local conservation initiatives and community-led projects, creating lasting positive impact."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.conservation-community') }}" class="mt-4">
                            Explore
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Our 5 Pillars Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-serif font-bold text-center text-[var(--color-forest-green)] mb-12">
                Our 5 Pillars
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <x-pillar-card 
                    title="Culture" 
                    description="Honoring and supporting traditional knowledge and cultural heritage."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('impact.responsible-travel') }}" class="mt-4 text-sm">
                            Learn More
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    title="Community" 
                    description="Investing in local leadership and sustainable livelihoods that benefit communities."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('impact.climate-community') }}" class="mt-4 text-sm">
                            Learn More
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    title="Conservation" 
                    description="Supporting projects that restore degraded landscapes and protect biodiversity."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('impact.responsible-travel') }}" class="mt-4 text-sm">
                            Learn More
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    title="Change Agents" 
                    description="Empowering local leaders and initiatives that drive positive transformation."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('trust.index') }}" class="mt-4 text-sm">
                            Learn More
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    title="Climate Action" 
                    description="Carbon-neutral journeys and support for climate resilience initiatives."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('impact.climate-community') }}" class="mt-4 text-sm">
                            Learn More
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Explore Africa Section -->
    <section class="py-16 bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-serif font-bold text-center text-[var(--color-forest-green)] mb-12">
                Explore Africa
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <x-country-card name="Kenya" slug="kenya" />
                <x-country-card name="Uganda" slug="uganda" />
                <x-country-card name="Tanzania" slug="tanzania" />
                <x-country-card name="Zambia" slug="zambia" />
                <x-country-card name="Zimbabwe" slug="zimbabwe" />
                <x-country-card name="Botswana" slug="botswana" />
                <x-country-card name="Namibia" slug="namibia" />
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Responsible Travel Teaser Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                        Responsible Travel & Carbon Offsetting
                    </h2>
                    <p class="text-lg text-[var(--color-earth-brown)] mb-6 leading-relaxed">
                        Our commitment to climate-positive travel. Every journey with Halisi Africa is designed to leave a positive footprint. We partner with 
                        conservation organizations, community-led initiatives, and sustainable accommodations to ensure 
                        your travel contributes to regeneration, not just preservation.
                    </p>
                    <x-button-secondary href="{{ route('impact.responsible-travel') }}">
                        Learn More
                    </x-button-secondary>
                </div>
                <div class="bg-[var(--color-sand-beige)] aspect-video rounded-lg"></div>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Women & Restoration Teaser -->
    <section class="py-16 bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 bg-[var(--color-sand-beige)] aspect-video rounded-lg"></div>
                <div class="order-1 lg:order-2">
                    <h2 class="text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                        Women & Restoration Projects
                    </h2>
                    <p class="text-lg text-[var(--color-earth-brown)] mb-6 leading-relaxed">
                        Mangrove Restoration & Seedball Safaris. Through the Halisi Trust, we support women-led restoration projects across Africa. 
                        These initiatives combine traditional knowledge with modern conservation practices, 
                        creating lasting change for communities and ecosystems.
                    </p>
                    <x-button-secondary href="{{ route('trust.index') }}">
                        Discover More
                    </x-button-secondary>
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Signature Journeys Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-serif font-bold text-center text-[var(--color-forest-green)] mb-12">
                Signature Journeys
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-pillar-card 
                    title="Wildlife Safaris" 
                    description="Experience Africa's iconic wildlife in their natural habitats through expertly guided safaris."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.signature-safaris') }}" class="mt-4">
                            View Journeys
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    title="Cultural Encounters" 
                    description="Connect with local communities and experience authentic African cultures and traditions."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.conservation-community') }}" class="mt-4">
                            View Journeys
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    title="Luxury Retreats" 
                    description="Indulge in exclusive accommodations and bespoke experiences in Africa's most stunning locations."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.luxury-retreats') }}" class="mt-4">
                            View Journeys
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Final CTA Section -->
    <section class="py-20 bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <x-button-primary href="{{ route('contact.index') }}" class="bg-white text-[var(--color-forest-green)] hover:bg-gray-100 text-lg px-8 py-4">
                Start Your Journey
            </x-button-primary>
        </div>
    </section>
@endsection
