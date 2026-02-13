@extends('layouts.app')

@section('title', 'Work With Us - Halisi Africa Discoveries')
@section('description', 'Partner with Halisi Africa. Collaborations that regenerate landscapes and livelihoods through regenerative travel.')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[70vh] flex items-center justify-center bg-[var(--color-forest-green)] text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60 z-10"></div>
            <div class="w-full h-full bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)]"></div>
        </div>
        
        <div class="relative z-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                Partner With Purpose
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto leading-relaxed">
                Collaborations that regenerate landscapes and livelihoods.
            </p>
        </div>
    </section>

    <!-- Design a Journey (Travellers) -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Design a Journey
                </h2>
            </div>
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] mb-8">
                <p class="text-lg leading-relaxed mb-6">
                    Ready to experience regenerative travel? Our team works with you to design a bespoke journey that aligns 
                    with your interests, values, and travel style. Every itinerary is crafted to create meaningful experiences 
                    while supporting conservation and community initiatives.
                </p>
                <p class="text-lg leading-relaxed">
                    Whether you're seeking wildlife encounters, cultural immersion, or luxury retreats, we'll create a journey 
                    that leaves more than footprints—it leaves legacy.
                </p>
            </div>
            
            <x-button-primary href="{{ route('contact.index', ['inquiry_type' => 'journey']) }}">
                Design Your Journey
            </x-button-primary>
        </div>
    </section>

    <x-section-divider />

    <!-- Trade & Collaborations -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Trade & Collaborations
                </h2>
                <p class="text-lg text-[var(--color-earth-brown)] max-w-3xl mx-auto">
                    Partner with Halisi Africa to offer regenerative travel experiences to your clients.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Travel Advisors -->
                <div class="bg-white p-8 rounded-lg">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Travel Advisors
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-6">
                        Offer your clients authentic, regenerative travel experiences across Africa. We provide comprehensive 
                        support, competitive rates, and transparent impact reporting for every journey.
                    </p>
                    <ul class="space-y-2 text-[var(--color-earth-brown)] text-sm mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Dedicated advisor support and resources</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Competitive commission structures</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Impact reporting for client transparency</span>
                        </li>
                    </ul>
                    <x-button-secondary href="{{ route('contact.index', ['inquiry_type' => 'advisor']) }}">
                        Partner With Us
                    </x-button-secondary>
                </div>
                
                <!-- Strategic Partners -->
                <div class="bg-white p-8 rounded-lg">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Strategic Partners
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-6">
                        Collaborate with us on initiatives that align regenerative travel with your organization's mission. 
                        We partner with brands, foundations, and organizations committed to positive impact.
                    </p>
                    <ul class="space-y-2 text-[var(--color-earth-brown)] text-sm mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Co-created journey experiences</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Shared impact measurement and reporting</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Brand alignment and storytelling</span>
                        </li>
                    </ul>
                    <x-button-secondary href="{{ route('contact.index', ['inquiry_type' => 'partnership']) }}">
                        Explore Partnership
                    </x-button-secondary>
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Conservation & Community Partners -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Conservation & Community Partners
                </h2>
            </div>
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] mb-8">
                <p class="text-lg leading-relaxed mb-6">
                    We partner with NGOs, foundations, and local initiatives to amplify conservation and community impact. 
                    If your organization is working on ecosystem restoration, wildlife protection, or community empowerment 
                    in East or Southern Africa, let's explore how regenerative travel can support your mission.
                </p>
                <p class="text-lg leading-relaxed">
                    Our partnerships create direct funding streams for conservation projects, support community-led initiatives, 
                    and provide travelers with authentic opportunities to engage with meaningful work on the ground.
                </p>
            </div>
            
            <div class="bg-[var(--color-off-white)] p-8 rounded-lg mb-8">
                <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                    Partnership Benefits
                </h3>
                <ul class="space-y-3 text-[var(--color-earth-brown)]">
                    <li class="flex items-start gap-3">
                        <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                        <span>Direct funding for your conservation or community initiatives</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                        <span>Platform to share your work with engaged, values-aligned travelers</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                        <span>Long-term partnership that evolves with your organization's needs</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                        <span>Transparent impact reporting and storytelling support</span>
                    </li>
                </ul>
            </div>
            
            <x-button-secondary href="{{ route('contact.index', ['inquiry_type' => 'conservation']) }}">
                Discuss Partnership
            </x-button-secondary>
        </div>
    </section>

    <x-section-divider />

    <!-- Media & Speaking -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Media & Speaking
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Speaking Engagements -->
                <div class="bg-white p-8 rounded-lg">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Speaking Engagements
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-6">
                        Our team speaks on regenerative tourism, conservation travel, and community-led impact at conferences, 
                        events, and educational institutions.
                    </p>
                    <x-button-secondary href="{{ route('contact.index', ['inquiry_type' => 'speaking']) }}">
                        Invite Us to Speak
                    </x-button-secondary>
                </div>
                
                <!-- Press & Media -->
                <div class="bg-white p-8 rounded-lg">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Press & Media
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-6">
                        For press inquiries, media features, or industry dialogue, we're available to discuss regenerative 
                        travel, conservation impact, and our approach to community partnerships.
                    </p>
                    <x-button-secondary href="{{ route('contact.index', ['inquiry_type' => 'media']) }}">
                        Media Inquiry
                    </x-button-secondary>
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Final CTA -->
    <section class="section-padding bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">
                Start the Conversation
            </h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Whether you're a traveler, advisor, partner, or media professional, we'd love to hear from you.
            </p>
            <x-button-primary href="{{ route('contact.index') }}" class="bg-white text-[var(--color-forest-green)] hover:bg-gray-100 text-lg px-10 py-5 border-0">
                Get in Touch
            </x-button-primary>
        </div>
    </section>
@endsection
