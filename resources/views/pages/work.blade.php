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
                Work with us
            </h1>
            <p class="text-base md:text-lg text-gray-100 max-w-xl mx-auto leading-snug">
                Partners · trips · media—same mission: women &amp; land.
            </p>
        </div>
    </section>

    <!-- Design a Journey (Travellers) -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Design a journey
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8 max-w-3xl js-scroll js-scroll-fade">
                <div class="flex items-center gap-3 p-4 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/60">
                    <span class="w-10 h-10 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] shrink-0" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                    </span>
                    <span class="text-sm font-medium text-[var(--color-forest-green)]">Your pace &amp; style</span>
                </div>
                <div class="flex items-center gap-3 p-4 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/60">
                    <span class="w-10 h-10 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] shrink-0" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <span class="text-sm font-medium text-[var(--color-forest-green)]">Wildlife &amp; culture</span>
                </div>
                <div class="flex items-center gap-3 p-4 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/60">
                    <span class="w-10 h-10 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] shrink-0" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </span>
                    <span class="text-sm font-medium text-[var(--color-forest-green)]">Impact built in</span>
                </div>
            </div>
            <p class="text-sm text-[var(--color-earth-brown)] mb-8 max-w-md js-scroll">Bespoke East &amp; Southern Africa—tell us what matters.</p>

            <x-button-primary href="{{ route('contact.index', ['inquiry_type' => 'journey']) }}">
                Start a trip
            </x-button-primary>
        </div>
    </section>

    

    <!-- Trade & Collaborations -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-2">
                    Trade &amp; collaborations
                </h2>
                <p class="text-sm text-[var(--color-earth-brown)] max-w-md mx-auto">For advisors &amp; brands.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 js-scroll-stagger">
                <!-- Travel Advisors -->
                <div class="bg-white p-8 rounded-lg">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Travel advisors
                    </h3>
                    <ul class="space-y-2.5 text-[var(--color-earth-brown)] text-sm mb-6">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] shrink-0" aria-hidden="true">◆</span> Support &amp; materials</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] shrink-0" aria-hidden="true">◆</span> Fair commissions</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] shrink-0" aria-hidden="true">◆</span> Impact you can show clients</li>
                    </ul>
                    <x-button-secondary href="{{ route('contact.index', ['inquiry_type' => 'advisor']) }}">
                        Partner
                    </x-button-secondary>
                </div>
                
                <!-- Strategic Partners -->
                <div class="bg-white p-8 rounded-lg">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Strategic partners
                    </h3>
                    <ul class="space-y-2.5 text-[var(--color-earth-brown)] text-sm mb-6">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] shrink-0" aria-hidden="true">◆</span> Co-built trips</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] shrink-0" aria-hidden="true">◆</span> Shared metrics</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] shrink-0" aria-hidden="true">◆</span> Story &amp; brand fit</li>
                    </ul>
                    <x-button-secondary href="{{ route('contact.index', ['inquiry_type' => 'partnership']) }}">
                        Talk partnerships
                    </x-button-secondary>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Conservation & Community Partners -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Conservation &amp; community
                </h2>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-8 js-scroll js-scroll-fade max-w-3xl">
                <div class="flex flex-col items-center text-center p-4 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/50">
                    <span class="w-9 h-9 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-2" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </span>
                    <span class="text-xs font-medium text-[var(--color-forest-green)]">Restore</span>
                </div>
                <div class="flex flex-col items-center text-center p-4 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/50">
                    <span class="w-9 h-9 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-2" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <span class="text-xs font-medium text-[var(--color-forest-green)]">Wildlife</span>
                </div>
                <div class="flex flex-col items-center text-center p-4 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/50">
                    <span class="w-9 h-9 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-2" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </span>
                    <span class="text-xs font-medium text-[var(--color-forest-green)]">People</span>
                </div>
                <div class="flex flex-col items-center text-center p-4 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/50">
                    <span class="w-9 h-9 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-2" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </span>
                    <span class="text-xs font-medium text-[var(--color-forest-green)] leading-tight">East &amp; Southern Africa</span>
                </div>
            </div>

            <div class="bg-[var(--color-off-white)] p-6 rounded-xl mb-8 border border-[var(--color-sand-beige)]/50">
                <h3 class="text-sm font-bold uppercase tracking-wide text-[var(--color-accent-gold)] mb-4">What we bring</h3>
                <ul class="grid sm:grid-cols-2 gap-2 text-[var(--color-earth-brown)] text-xs sm:text-sm">
                    <li class="flex gap-2"><span class="text-[var(--color-accent-gold)] shrink-0">◆</span> Funding toward your projects</li>
                    <li class="flex gap-2"><span class="text-[var(--color-accent-gold)] shrink-0">◆</span> Guests who care</li>
                    <li class="flex gap-2"><span class="text-[var(--color-accent-gold)] shrink-0">◆</span> Long-term, flexible ties</li>
                    <li class="flex gap-2"><span class="text-[var(--color-accent-gold)] shrink-0">◆</span> Clear impact reporting</li>
                </ul>
            </div>

            <x-button-secondary href="{{ route('contact.index', ['inquiry_type' => 'conservation']) }}">
                NGO / field partner
            </x-button-secondary>
        </div>
    </section>

    

    <!-- Media & Speaking -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Media &amp; speaking
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 js-scroll-stagger">
                <div class="bg-white p-6 md:p-8 rounded-xl border border-[var(--color-sand-beige)]/40 shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-4" aria-hidden="true">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/></svg>
                    </div>
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-2">
                        Speaking
                    </h3>
                    <p class="text-xs sm:text-sm text-[var(--color-earth-brown)] leading-snug mb-6">
                        Panels &amp; schools—regenerative travel, conservation, community impact.
                    </p>
                    <x-button-secondary href="{{ route('contact.index', ['inquiry_type' => 'speaking']) }}">
                        Invite us
                    </x-button-secondary>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-xl border border-[var(--color-sand-beige)]/40 shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-4" aria-hidden="true">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-2">
                        Press
                    </h3>
                    <p class="text-xs sm:text-sm text-[var(--color-earth-brown)] leading-snug mb-6">
                        Features, quotes, background on how we work.
                    </p>
                    <x-button-secondary href="{{ route('contact.index', ['inquiry_type' => 'media']) }}">
                        Media line
                    </x-button-secondary>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Final CTA -->
    <section class="section-padding bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center js-scroll">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-4">
                Say hello
            </h2>
            <p class="text-sm md:text-base text-gray-100 mb-8 max-w-md mx-auto leading-snug">
                Traveler, trade, NGO, or press—we reply in person.
            </p>
            <x-button-primary href="{{ route('contact.index') }}" class="bg-[var(--color-accent-gold)] text-[var(--color-forest-green)] hover:bg-[#e8c57a] text-base px-8 py-4 border border-white">
                Contact
            </x-button-primary>
        </div>
    </section>
@endsection
