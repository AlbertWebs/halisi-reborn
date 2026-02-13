@extends('layouts.app')

@section('title', 'Halisi Africa Discoveries - Authentic African Journeys')
@section('description', 'Authentic African Journeys, Designed to Regenerate')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center justify-center parallax-container">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[var(--color-forest-green)] opacity-60 z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60 z-10"></div>
            <!-- Placeholder for hero image - replace with actual image -->
            <!-- Preload critical hero image here when available -->
            <div class="w-full h-full bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)]"></div>
        </div>
        
        <!-- Content -->
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif font-bold mb-6 text-balance leading-tight">
                    Authentic African Journeys, Designed to Regenerate
                </h1>
                <p class="text-xl md:text-2xl mb-10 text-gray-100 max-w-3xl mx-auto text-balance">
                    Luxury travel across Africa, rooted in conservation and community.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <x-button-primary href="{{ route('contact.index') }}" class="text-lg px-8 py-4 bg-white text-[var(--color-forest-green)] hover:bg-gray-100 border-0">
                        Design Your Journey
                    </x-button-primary>
                    <x-button-secondary href="{{ route('journeys.index') }}" class="text-lg px-8 py-4 bg-transparent text-white border-2 border-white hover:bg-white hover:text-[var(--color-forest-green)]">
                        Explore Journeys
                    </x-button-secondary>
                </div>
            </div>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-8"></div>
            </div>
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Welcome to Halisi Africa Discoveries
                </h2>
                <p class="text-lg md:text-xl text-[var(--color-earth-brown)] leading-relaxed max-w-3xl mx-auto">
                    Crafting bespoke, luxury experiences across Africa—with purpose and impact.
                </p>
            </div>
        </div>
    </section>

    <!-- Our Experiences Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-center text-[var(--color-forest-green)] mb-16">
                Our Experiences
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                <x-pillar-card 
                    title="Bespoke Safaris" 
                    description="Immersive wildlife experiences in pristine wilderness areas, guided by expert naturalists who share deep knowledge of ecosystems and conservation."
                    icon='<svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>'
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.signature-safaris') }}">
                            Explore
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    title="Luxury Escapes" 
                    description="Bespoke accommodations and curated experiences that blend comfort with authenticity, ensuring every moment reflects the spirit of Africa."
                    icon='<svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>'
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.luxury-retreats') }}">
                            Explore
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    title="Conservation & Community" 
                    description="Journeys that directly support local conservation initiatives and community-led projects, creating lasting positive impact."
                    icon='<svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>'
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.conservation-community') }}">
                            Explore
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Our 5 Pillars Section -->
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-center text-[var(--color-forest-green)] mb-16">
                Our 5 Pillars
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-8">
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
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-center text-[var(--color-forest-green)] mb-16">
                Explore Africa
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
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
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 relative">
                    <div class="bg-[var(--color-sand-beige)] aspect-video rounded-lg overflow-hidden">
                        <!-- Placeholder for image -->
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                        Women & Restoration Projects
                    </h2>
                    <p class="text-lg text-[var(--color-earth-brown)] mb-8 leading-relaxed">
                        <strong>Mangrove Restoration & Seedball Safaris.</strong> Through the Halisi Trust, we support women-led restoration projects across Africa. 
                        These initiatives combine traditional knowledge with modern conservation practices, 
                        creating lasting change for communities and ecosystems.
                    </p>
                    
                    <!-- Stat Preview Blocks -->
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-white p-4 rounded-lg border border-[var(--color-sand-beige)]">
                            <div class="text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-1">1:1</div>
                            <div class="text-sm text-[var(--color-earth-brown)]">One Tourist = One Mangrove</div>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-[var(--color-sand-beige)]">
                            <div class="text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-1">100%</div>
                            <div class="text-sm text-[var(--color-earth-brown)]">Women-Led Projects</div>
                        </div>
                    </div>
                    
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
    <section class="section-padding-lg bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold mb-8 text-balance">
                Design a Journey That Leaves More Than Footprints
            </h2>
            <x-button-primary href="{{ route('contact.index') }}" class="bg-white text-[var(--color-forest-green)] hover:bg-gray-100 text-lg px-10 py-5 border-0">
                Start Your Journey
            </x-button-primary>
        </div>
    </section>
@endsection
