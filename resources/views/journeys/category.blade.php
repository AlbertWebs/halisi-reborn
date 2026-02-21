@extends('layouts.app')

@php
    $categoryDescriptions = [
        'Signature Safaris' => 'Immersive wildlife experiences in Africa\'s most iconic wilderness areas, guided by expert naturalists who share deep knowledge of ecosystems and conservation.',
        'Bespoke Private Travel' => 'Exclusively designed journeys tailored to your interests, values, and travel style. Every detail curated for authentic, meaningful experiences.',
        'Conservation & Community' => 'Journeys that directly support local conservation initiatives and community-led projects, creating lasting positive impact for ecosystems and people.',
        'Luxury Retreats' => 'Indulge in exceptional accommodations and curated experiences that blend comfort with authenticity in Africa\'s most stunning locations.',
    ];
    
    $categoryHeadlines = [
        'Signature Safaris' => 'Where Wildlife Meets Conservation',
        'Bespoke Private Travel' => 'Your Journey, Your Story',
        'Conservation & Community' => 'Travel That Transforms',
        'Luxury Retreats' => 'Luxury Rooted in Purpose',
    ];
    
    $description = $categoryDescriptions[$category] ?? 'Explore our ' . strtolower($category) . ' journeys designed to regenerate ecosystems and empower communities.';
    $headline = $categoryHeadlines[$category] ?? $category;
@endphp

@section('title', $category . ' - Halisi Africa Discoveries')
@section('description', $description)

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[70vh] flex items-center justify-center bg-[var(--color-forest-green)] text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60 z-10"></div>
            <div class="w-full h-full bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)]"></div>
        </div>
        
        <div class="relative z-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                {{ $headline }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto leading-relaxed">
                {{ $description }}
            </p>
        </div>
    </section>

    <!-- Journey Grid Section -->
    <section class="section-padding bg-white">
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
                        {{ $category }} journeys are coming soon. Check back soon or contact us to design a bespoke journey.
                    </p>
                    <x-button-primary href="{{ route('contact.index') }}">
                        Design Your Journey
                    </x-button-primary>
                </div>
            @endif
        </div>
    </section>

    <x-section-divider />

    <!-- Regenerative Angle Block -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Regenerative Impact
                </h2>
            </div>
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] text-center">
                <p class="text-lg leading-relaxed mb-6">
                    Every {{ strtolower($category) }} journey with Halisi Africa is designed to create measurable positive impact. 
                    Through direct support for conservation projects, community-led initiatives, and nature-based solutions, 
                    your travel becomes a force for regeneration.
                </p>
                <p class="text-lg leading-relaxed">
                    We partner with local communities, conservation organizations, and sustainable accommodations to ensure 
                    that every journey contributes to ecosystem restoration, wildlife protection, and community empowerment. 
                    Travel with purpose, travel with impact.
                </p>
            </div>
            
            <div class="mt-12 text-center">
                <x-button-secondary href="{{ route('impact.responsible-travel') }}">
                    Learn About Our Impact
                </x-button-secondary>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- CTA Block -->
    <section class="section-padding bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">
                Design Your Private Journey
            </h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Let us craft a bespoke {{ strtolower($category) }} experience tailored to your interests, values, and travel style.
            </p>
            <x-button-primary href="{{ route('contact.index') }}" class="text-lg px-10 py-5 border-0">
                Start Your Journey
            </x-button-primary>
        </div>
    </section>
@endsection
