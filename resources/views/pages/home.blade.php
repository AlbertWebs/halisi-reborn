@extends('layouts.app-home')

@section('title', 'Halisi Africa Discoveries - Authentic African Journeys')
@section('description', 'Authentic African Journeys, Designed to Regenerate')


@include('pages.homecss')


@section('content')
    <!-- Hero Section -->
    <section id="hero-section" 
        class="hero-section-wrapper relative min-h-screen flex items-center justify-center hero-section-full-viewport">
        <!-- Background Video with Overlay -->
        <div class="hero-video-container z-0" > <!-- Vimeo Video Background -->
            <div class="video-wrapper"> <iframe  id="hero-vimeo-iframe" 
                    src="https://player.vimeo.com/video/1058906686?background=1&autoplay=1&loop=1&muted=1&controls=0&playsinline=0"
                    frameborder="0" allow="autoplay; fullscreen;" allowfullscreen> </iframe> 
                </div>
            <!-- Overlay for better text readability -->
            <div class="absolute inset-0 bg-[var(--color-forest-green)] opacity-40 z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/60 z-10"></div>
            <!-- Callout inside video container so on mobile it stays over the video -->
            <div class="hero-eco-callout">
                <p class="callout-subtitle">{!! nl2br(e($heroCalloutSection?->subtitle ?: "Immerse yourself in our wild,\nprecious world")) !!}</p>
                <p class="callout-title">{{ $heroCalloutSection?->title ?: 'Where Eco is Luxury' }}</p> <a
                    href="#welcome-section" class="callout-arrow-link" aria-label="Scroll to welcome section"> <span
                        class="callout-arrow-line" aria-hidden="true"></span> <span class="callout-arrow-line second"
                        aria-hidden="true"></span> </a>
            </div>
        </div>
        <div id="hero-video-preloader" class="hero-video-preloader" aria-live="polite" 
            aria-label="Loading background video">
            <div class="hero-video-preloader-spinner" aria-hidden="true"></div>
        </div> <!-- Content -->
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center text-white">
                @if (filled($heroSection?->title))
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif font-bold mb-6 text-balance leading-tight fade-up-on-scroll">
                        {{ $heroSection->title }} </h1>
                    @endif @if (filled($heroSection?->subtitle))
                        <p
                            class="text-xl md:text-2xl mb-10 text-gray-100 max-w-3xl mx-auto text-balance fade-up-on-scroll animation-delay-200">
                            {{ $heroSection->subtitle }} </p>
                        @endif @if (filled($heroSection?->cta_label) && filled($heroSection?->cta_link))
                            <div
                                class="flex flex-col sm:flex-row gap-4 justify-center fade-up-on-scroll animation-delay-400">
                                <x-button-primary href="{{ $heroSection->cta_link }}"
                                    class="text-lg px-8 py-4 bg-white text-[var(--color-forest-green)] hover:bg-gray-100 border-0">
                                    {{ $heroSection->cta_label }} </x-button-primary> </div>
                        @endif
            </div>
        </div>
    </section>

     

    <!-- Welcome Section -->
    <section id="welcome-section" class="section-padding bg-white about-green-section">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="about-green-content">
                <p class="about-green-intro">{{ $introSection?->subtitle ?: 'Welcome To' }}</p>
                <h2 class="about-green-title">
                    {{ $introSection?->title ?: 'Halisi Africa Discoveries' }}
                </h2>
                <div class="about-green-copy">
                    {!! $introSection?->content ?: 'Crafting bespoke, luxury experiences across Africa with purpose and impact. From remote wilderness camps to curated conservation journeys, every itinerary is designed to immerse guests in extraordinary landscapes while supporting communities and ecosystems for generations to come.' !!}
                </div>
                <!-- <div class="about-green-actions">
                    <x-button-secondary href="{{ route('trust.index') }}" class="inline-block">
                        Our Stories
                    </x-button-secondary>
                </div> -->
            </div>
        </div>
        <!-- <br><br>
        <div class="about-green-ghost" aria-hidden="true">Crafting Bespoke Luxury<br> Experiences Across Africa</div> -->
    </section>

    <!-- <section id="welcome-section" class="section-padding bg-white about-green-section">
       
        <div class="about-green-ghost" aria-hidden="true">Crafting Bespoke Luxury<br> Experiences Across Africa</div>
    </section> -->

    <!-- Our Experiences Section -->
    <section class="section-padding bg-[var(--color-off-white)] experiences-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-center text-[var(--color-forest-green)] mb-10 md:mb-12">
                Our Experiences
            </h2>
       
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-10 experience-grid items-stretch">
                <div class="experience-card flex flex-col overflow-hidden bg-white rounded-lg">
                    <img src="{{ (isset($experienceSections['experience_safaris']) && $experienceSections['experience_safaris']->image) ? asset('storage/' . $experienceSections['experience_safaris']->image) : asset('/og-image.jpg') }}" alt="Bespoke Safaris" class="experience-image">
                    <div class="experience-overlay"></div>
                    <div class="experience-content">
                        <h3 class="experience-title text-xl lg:text-2xl font-serif font-semibold">Bespoke Safaris</h3>
                        <div>
                            <x-button-secondary href="{{ route('journeys.signature-safaris') }}" class="experience-card-btn border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent text-sm px-4 py-2">
                                View Safaris
                            </x-button-secondary>
                        </div>
                    </div>
                </div>

                <div class="experience-card flex flex-col overflow-hidden bg-white rounded-lg">
                    <img src="{{ (isset($experienceSections['experience_luxury']) && $experienceSections['experience_luxury']->image) ? asset('storage/' . $experienceSections['experience_luxury']->image) : asset('/og-image.jpg') }}" alt="Luxury Escapes" class="experience-image">
                    <div class="experience-overlay"></div>
                    <div class="experience-content">
                        <h3 class="experience-title text-xl lg:text-2xl font-serif font-semibold">Luxury Escapes</h3>
                        <div>
                            <x-button-secondary href="{{ route('journeys.luxury-retreats') }}" class="experience-card-btn border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent text-sm px-4 py-2">
                                View Escapes
                            </x-button-secondary>
                        </div>
                    </div>
                </div>

                <div class="experience-card flex flex-col overflow-hidden bg-white rounded-lg">
                    <img src="{{ (isset($experienceSections['experience_community']) && $experienceSections['experience_community']->image) ? asset('storage/' . $experienceSections['experience_community']->image) : asset('/og-image.jpg') }}" alt="Conservation and Community" class="experience-image">
                    <div class="experience-overlay"></div>
                    <div class="experience-content">
                        <h3 class="experience-title text-xl lg:text-2xl font-serif font-semibold">Conservation &amp; Community</h3>
                        <div>
                            <x-button-secondary href="{{ route('journeys.conservation-community') }}" class="experience-card-btn border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent text-sm px-4 py-2">
                                View Impact Journeys
                            </x-button-secondary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 

    <!-- Our 5 Pillars Section (design from About: The 5 Regenerative Pillars - Expanded) -->
    <section class="section-padding bg-white">
        @php
            $pillarCulture = $pillarSections['pillar_culture'] ?? null;
            $pillarCommunity = $pillarSections['pillar_community'] ?? null;
            $pillarConservation = $pillarSections['pillar_conservation'] ?? null;
            $pillarChangeAgents = $pillarSections['pillar_change_agents'] ?? null;
            $pillarClimateAction = $pillarSections['pillar_climate_action'] ?? null;
            $pillars = [
                ['section' => $pillarCulture, 'title' => 'Culture', 'fallback' => 'Honoring and supporting traditional knowledge, cultural heritage, and indigenous practices that have sustained communities for generations.', 'cta_link' => route('impact.responsible-travel'), 'svg' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['section' => $pillarCommunity, 'title' => 'Community', 'fallback' => 'Investing in local leadership, sustainable livelihoods, and community-led initiatives that create lasting positive change.', 'cta_link' => route('impact.climate-community'), 'svg' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                ['section' => $pillarConservation, 'title' => 'Conservation', 'fallback' => 'Supporting projects that restore degraded landscapes, protect biodiversity, and ensure wildlife and ecosystems thrive for future generations.', 'cta_link' => route('impact.responsible-travel'), 'svg' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['section' => $pillarChangeAgents, 'title' => 'Change Agents', 'fallback' => 'Empowering local leaders, innovators, and initiatives that drive positive transformation in their communities and ecosystems.', 'cta_link' => route('trust.index'), 'svg' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                ['section' => $pillarClimateAction, 'title' => 'Climate Action', 'fallback' => 'Carbon-neutral journeys and support for climate resilience initiatives that protect communities and ecosystems from climate impacts.', 'cta_link' => route('impact.climate-community'), 'svg' => 'M12 3v18m9-9H3'],
            ];
            @endphp
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Our 5 Pillars
                </h2>
                <p class="text-sm sm:text-base md:text-lg text-[var(--color-earth-brown)] max-w-[18rem] sm:max-w-2xl md:max-w-3xl mx-auto">
                    These pillars guide every journey we design and every partnership we form.
                </p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-8">
                @foreach($pillars as $p)
                    <div class="text-center">
                        <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                            @if($p['section'] && $p['section']->image)
                                <img src="{{ asset('storage/' . $p['section']->image) }}" alt="{{ $p['title'] }}" class="w-8 h-8 object-contain">
                            @else
                                <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $p['svg'] }}"></path>
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">{{ $p['section']?->title ?? $p['title'] }}</h3>
                        <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">
                            {{ filled($p['section']?->content ?? null) ? Str::limit(strip_tags($p['section']?->content ?? ''), 180) : $p['fallback'] }}
                        </p>
                        <div class="mt-4">
                            <x-button-secondary href="{{ filled($p['section']?->cta_link ?? null) ? $p['section']?->cta_link : $p['cta_link'] }}" class="text-sm">
                                {{ filled($p['section']?->cta_label ?? null) ? $p['section']?->cta_label : 'Learn More' }}
                            </x-button-secondary>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    

    <!-- Explore Africa Section - Grid (all countries visible) -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    Explore Africa
                </h2>
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 explore-africa-grid">
                @foreach($exploreCountries as $country)
                    <x-country-card
                        :name="$country->name"
                        :slug="$country->slug"
                        :image="$country->hero_image ? asset('storage/' . $country->hero_image) : null"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <script>
        const heroVideoIframe = document.getElementById('hero-vimeo-iframe');
        const heroVideoPreloader = document.getElementById('hero-video-preloader');

        function hideHeroVideoPreloader() {
            if (!heroVideoPreloader) return;
            heroVideoPreloader.classList.add('is-hidden');
        }

        if (heroVideoIframe && heroVideoPreloader) {
            heroVideoIframe.addEventListener('load', hideHeroVideoPreloader, { once: true });
            // Fallback: avoid stuck loader on slow/blocked third-party video requests.
            window.setTimeout(hideHeroVideoPreloader, 6500);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const sections = Array.from(document.querySelectorAll('main#main-content section'));
            if (!sections.length) return;

            const revealSections = sections.filter((section) => !section.classList.contains('hero-section-wrapper'));
            revealSections.forEach((section, index) => {
                section.classList.add('scroll-reveal-section');
                section.style.transitionDelay = `${Math.min((index % 4) * 70, 210)}ms`;
            });

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.14,
                rootMargin: '0px 0px -6% 0px'
            });

            revealSections.forEach((section) => revealObserver.observe(section));

            const backToHeroBtn = document.getElementById('back-to-hero-btn');
            const heroSection = document.getElementById('hero-section');
            if (backToHeroBtn && heroSection) {
                const toggleBackToHero = () => {
                    const heroBottom = heroSection.getBoundingClientRect().bottom;
                    if (window.scrollY > window.innerHeight * 0.4) {
                        backToHeroBtn.classList.remove('opacity-0', 'pointer-events-none');
                    } else {
                        backToHeroBtn.classList.add('opacity-0', 'pointer-events-none');
                    }
                };
                window.addEventListener('scroll', toggleBackToHero, { passive: true });
                toggleBackToHero();
            }
        });
    </script>


    <!-- Responsible Travel Teaser Section -->
    <section class="luxury-teaser-section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 luxury-equal-grid">
                <div class="luxury-copy-col">
                    <h2 class="luxury-heading mobile-underline-fit font-serif font-bold text-[var(--color-forest-green)] mb-0 text-center md:text-left">
                        {{ $responsibleTravelSection?->title ?: 'Responsible Travel & Carbon Offsetting' }}
                    </h2>
                    <br>
               
                    {!! $responsibleTravelSection?->content ?: 'Our commitment to climate-positive travel. Every journey with Halisi Africa is designed to leave a positive footprint. We partner with conservation organizations, community-led initiatives, and sustainable accommodations to ensure your travel contributes to regeneration, not just preservation.' !!}
                    <br>
                    @if(filled($responsibleTravelSection?->cta_label) && filled($responsibleTravelSection?->cta_link))
                        <x-button-secondary href="{{ $responsibleTravelSection->cta_link }}" class="inline-flex w-auto self-start text-sm px-6 py-3 tracking-wide">
                            {{ $responsibleTravelSection->cta_label }}
                        </x-button-secondary>
                    @else
                        <x-button-secondary href="{{ route('impact.responsible-travel') }}" class="inline-flex w-auto self-start text-sm px-6 py-3 tracking-wide">
                            Learn More
                        </x-button-secondary>
                    @endif
                </div>
                <div class="luxury-media-col">
                    <div class="luxury-media-frame bg-[var(--color-sand-beige)]">
                    @if(filled($responsibleTravelSection?->image))
                        <img
                            src="{{ asset('storage/' . $responsibleTravelSection->image) }}"
                            alt="{{ $responsibleTravelSection?->title ?: 'Responsible travel teaser image' }}"
                            class="w-full h-full object-cover"
                        >
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <!-- Women & Restoration Teaser -->
    <section class="luxury-teaser-section bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 luxury-equal-grid">
                <div class="order-2 lg:order-1 relative luxury-media-col">
                    <div class="luxury-media-frame bg-[var(--color-sand-beige)]">
                        @if(filled($womenRestorationSection?->image))
                            <img
                                src="{{ asset('storage/' . $womenRestorationSection->image) }}"
                                alt="{{ $womenRestorationSection?->title ?: 'Women and restoration teaser image' }}"
                                class="w-full h-full object-cover"
                            >
                        @endif
                    </div>
                </div>
                <div class="order-1 lg:order-2 luxury-copy-col">
                    <h2 class="luxury-heading mobile-underline-fit women-restoration-title-tight font-serif font-bold text-[var(--color-forest-green)] mb-0 text-center md:text-left">
                        {{ $womenRestorationSection?->title ?: 'Women & Restoration Projects' }}
                    </h2>
                    <br>
                    
                    {!! $womenRestorationSection?->content ?: '<strong>Mangrove Restoration & Seedball Safaris.</strong> Through the Halisi Trust, we support women-led restoration projects across Africa. These initiatives combine traditional knowledge with modern conservation practices, creating lasting change for communities and ecosystems.' !!}
                    
                    
                    <!-- Stat Preview Blocks -->
                    <div class="mt-8 mb-10 flex">
                        <div class="luxury-stat-card px-5 py-4 min-w-[12rem] text-center rounded-xl">
                            <div class="text-3xl font-serif font-bold text-[var(--color-forest-green)] leading-none mb-2">100%</div>
                            <div class="text-[0.72rem] uppercase tracking-[0.14em] text-[var(--color-earth-brown)]">Women-Led Projects</div>
                        </div>
                    </div>
                    
                    @if(filled($womenRestorationSection?->cta_label) && filled($womenRestorationSection?->cta_link))
                        <x-button-secondary href="{{ $womenRestorationSection->cta_link }}" class="inline-flex w-auto self-start text-sm px-6 py-3 tracking-wide">
                            {{ $womenRestorationSection->cta_label }}
                        </x-button-secondary>
                    @else
                        <x-button-secondary href="{{ route('trust.index') }}" class="inline-flex w-auto self-start text-sm px-6 py-3 tracking-wide">
                            Discover More
                        </x-button-secondary>
                    @endif
                </div>
            </div>
        </div>
    </section>

   

    <!-- Signature Journeys Section -->
    <section class="luxury-teaser-section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="luxury-heading font-serif font-bold text-center text-[var(--color-forest-green)] mb-14 md:text-center">
                Signature Journeys
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-10">
                <x-pillar-card 
                    class="signature-journey-card"
                    title="Wildlife Safaris" 
                    description="Experience Africa's iconic wildlife in their natural habitats through expertly guided safaris."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.signature-safaris') }}" class="text-sm px-5 py-2.5">
                            View Journeys
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    class="signature-journey-card"
                    title="Cultural Encounters" 
                    description="Connect with local communities and experience authentic African cultures and traditions."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.conservation-community') }}" class="text-sm px-5 py-2.5">
                            View Journeys
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    class="signature-journey-card"
                    title="Luxury Retreats" 
                    description="Indulge in exclusive accommodations and bespoke experiences in Africa's most stunning locations."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('journeys.luxury-retreats') }}" class="text-sm px-5 py-2.5">
                            View Journeys
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
            </div>
        </div>
    </section>

  

    <!-- Final CTA Section -->
    <section class="section-padding-lg final-luxury-cta text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-10 text-balance leading-tight">
                Design a Journey That Leaves More Than Footprints
            </h2>
            <x-button-primary href="{{ route('contact.index') }}" class="text-lg md:text-xl px-10 md:px-12 py-5 border-0 tracking-wide">
                Start Your Journey
            </x-button-primary>
        </div>
    </section>

    <!-- Back to hero arrow (fixed bottom right); shown when user has scrolled down -->
    <a href="#hero-section" id="back-to-hero-btn" class="back-to-hero-arrow fixed bottom-20 md:bottom-8 right-4 md:right-8 z-30 w-12 h-12 md:w-14 md:h-14 rounded-full bg-[var(--color-nav-active)] text-white shadow-lg hover:bg-[var(--color-forest-green)] focus:outline-none focus:ring-2 focus:ring-[var(--color-nav-active)] focus:ring-offset-2 flex items-center justify-center transition-all duration-300 opacity-0 pointer-events-none" aria-label="Back to hero section">
        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </a>
@endsection
