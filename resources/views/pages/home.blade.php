@extends('layouts.app')

@section('title', 'Halisi Africa Discoveries - Authentic African Journeys')
@section('description', 'Authentic African Journeys, Designed to Regenerate')

<style>
/* Hero section fills viewport so video can stretch to cover header + callout */
.hero-section-full-viewport {
    height: 100vh;
    height: 100dvh;
    min-height: 100vh;
    min-height: 100dvh;
}

.video-wrapper {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
}

/* Stretch video to cover full hero (header + callout); no fixed height - overrides app.css viewport sizing */
section.hero-section-wrapper .video-wrapper iframe {
    position: absolute !important;
    top: 50% !important;
    left: 50% !important;
    right: auto !important;
    bottom: auto !important;
    width: 100% !important;
    height: 100% !important;
    min-width: 100% !important;
    min-height: 100% !important;
    max-width: none !important;
    margin: 0 !important;
    transform: translate(-50%, -50%) !important;
    pointer-events: none;
    border: 0;
}

.hero-video-preloader {
    position: absolute;
    inset: 0;
    z-index: 15;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.45);
    opacity: 1;
    visibility: visible;
    transition: opacity 0.45s ease, visibility 0.45s ease;
}

.hero-video-preloader.is-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

.hero-video-preloader-spinner {
    width: 2.6rem;
    height: 2.6rem;
    border: 2px solid rgba(255, 255, 255, 0.35);
    border-top-color: rgba(255, 255, 255, 0.98);
    border-radius: 9999px;
    animation: heroSpin 0.9s linear infinite;
}

.hero-eco-callout {
    position: absolute;
    left: 50%;
    bottom: 2rem;
    transform: translateX(-50%);
    z-index: 30;
    color: #fff;
    text-align: center;
}

.hero-eco-callout .callout-subtitle {
    font-size: 1.35rem;
    line-height: 1.35;
    color: rgba(255, 255, 255, 0.92);
}

.hero-eco-callout .callout-title {
    font-size: 1.55rem;
    line-height: 1.2;
    font-weight: 700;
    margin-top: 0.35rem;
}

.hero-eco-callout .callout-arrow-link {
    margin-top: 0.75rem;
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.22rem;
    padding: 0.35rem 0.5rem;
    border-radius: 9999px;
    transition: transform 0.2s ease, background-color 0.2s ease;
    animation: calloutArrowDown 1.6s ease-in-out infinite;
}

.hero-eco-callout .callout-arrow-link:hover {
    transform: translateY(2px);
    background-color: rgba(255, 255, 255, 0.08);
}

.hero-eco-callout .callout-arrow-link:focus-visible {
    outline: 2px solid rgba(255, 255, 255, 0.95);
    outline-offset: 3px;
}

.hero-eco-callout .callout-arrow-line {
    width: 1rem;
    height: 1rem;
    border-right: 2px solid rgba(255, 255, 255, 0.95);
    border-bottom: 2px solid rgba(255, 255, 255, 0.95);
    transform: rotate(45deg);
    display: block;
}

.hero-eco-callout .callout-arrow-line.second {
    margin-top: -0.45rem;
    opacity: 0.75;
}

.scroll-reveal-section {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity 0.7s ease, transform 0.7s ease;
    will-change: opacity, transform;
}

.scroll-reveal-section.is-visible {
    opacity: 1;
    transform: translateY(0);
}

.about-green-section {
    position: relative;
    overflow: hidden;
}

.about-green-layout {
    display: grid;
    gap: 2rem;
    align-items: stretch;
}

.about-green-content {
    text-align: center;
}

.about-green-ghost {
    position: absolute;
    inset: auto 0 1rem 0;
    text-align: center;
    font-size: clamp(1.2rem, 3.2vw, 2.4rem);
    font-weight: 700;
    letter-spacing: 0.05em;
    color: rgba(26, 77, 58, 0.08);
    text-transform: uppercase;
    pointer-events: none;
    user-select: none;
}

.about-green-intro {
    color: var(--color-forest-green);
    font-size: 0.95rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    margin-bottom: 0.6rem;
}

.about-green-title {
    font-family: var(--font-serif);
    color: var(--color-forest-green);
    line-height: 1.05;
    font-size: clamp(2rem, 6vw, 4rem);
    margin-bottom: 1.25rem;
}

.about-green-copy {
    max-width: 58rem;
    margin: 0 auto;
    color: var(--color-earth-brown);
    font-size: clamp(0.95rem, 1.6vw, 1.15rem);
    line-height: 1.8;
}

.about-green-image-wrap {
    position: relative;
    z-index: 10;
    height: 100%;
}

.about-green-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 0.75rem;
    border: 1px solid rgba(26, 77, 58, 0.2);
    box-shadow: 0 18px 50px rgba(0, 0, 0, 0.12);
}

.about-green-actions {
    margin-top: 1.5rem;
}

.experiences-section .experience-grid .experience-card {
    position: relative;
    height: 100%;
    min-height: 24rem;
    border: 1px solid rgba(26, 77, 58, 0.12);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
}

.experiences-section .experience-grid .experience-card .experience-image {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.experiences-section .experience-grid .experience-card .experience-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.62), rgba(0, 0, 0, 0.35));
}

.experiences-section .experience-grid .experience-card .experience-content {
    position: absolute;
    inset: 0;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    text-align: center;
    padding: 1.5rem 1.25rem 1.75rem;
}

.experiences-section .experience-grid .experience-card .experience-title {
    color: #fff;
    margin-bottom: 0.75rem;
}

.experiences-section .experience-grid .experience-card .experience-card-btn {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    border-width: 1px;
}

.experiences-section .experience-grid .experience-card .experience-content a:hover {
    color: var(--color-nav-active) !important;
    font-weight: 700 !important;
}

.pillars-section .pillars-grid {
    align-items: stretch;
}

.pillars-section .pillar-card-eq {
    height: 100%;
    display: flex;
    flex-direction: column;
    text-align: center;
    border: 1px solid rgba(26, 77, 58, 0.12);
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.05);
}

.pillars-section .pillar-card-eq h3,
.pillars-section .pillar-card-eq p {
    text-align: center;
}

.pillars-section .pillar-card-eq > .mb-6 {
    margin-left: auto;
    margin-right: auto;
    width: 6rem;
    height: 6rem;
    background: transparent;
    border-radius: 0;
}

.pillars-section .pillar-card-eq > .mb-6 svg,
.pillars-section .pillar-card-eq > .mb-6 img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.pillars-section .pillar-card-eq .mt-6 {
    margin-top: auto;
    display: flex;
    justify-content: center;
}

.explore-africa-grid a {
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: box-shadow 0.25s ease, transform 0.25s ease;
}
.explore-africa-grid a:hover {
    box-shadow: 0 12px 32px rgba(26, 77, 58, 0.18);
    transform: translateY(-2px);
}

.luxury-teaser-section {
    padding-top: clamp(4.5rem, 7vw, 6.5rem);
    padding-bottom: clamp(4.5rem, 7vw, 6.5rem);
}

.luxury-equal-grid {
    align-items: stretch;
}

.luxury-copy-col {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
}

.luxury-media-col {
    height: 100%;
}

.luxury-heading {
    font-size: clamp(1.875rem, 2.7vw, 2.25rem);
    line-height: 1.2;
    letter-spacing: 0.01em;
}

.luxury-body-copy {
    font-size: clamp(1.02rem, 1.45vw, 1.22rem);
    line-height: 1.85;
    max-width: 60ch;
}

.women-restoration-title-tight {
    line-height: 0.95;
}

.women-restoration-copy-tight {
    margin-top: -0.75rem;
}

.luxury-media-frame {
    border-radius: 1rem;
    overflow: hidden;
    border: 1px solid rgba(26, 77, 58, 0.12);
    box-shadow: 0 14px 40px rgba(17, 24, 39, 0.1);
    height: 100%;
}

.luxury-stat-card {
    border: 1px solid rgba(26, 77, 58, 0.16);
    border-radius: 0.9rem;
    background: rgba(255, 255, 255, 0.96);
    box-shadow: 0 6px 20px rgba(17, 24, 39, 0.06);
}

.signature-journey-card {
    border: 1px solid rgba(26, 77, 58, 0.12);
    border-radius: 0.95rem;
    box-shadow: 0 10px 24px rgba(17, 24, 39, 0.06);
    text-align: center;
}

.signature-journey-card h3,
.signature-journey-card p {
    text-align: center;
}

.signature-journey-card > .mt-6 {
    display: flex;
    justify-content: center;
}

.final-luxury-cta {
    background: linear-gradient(160deg, #1a4d3a 0%, #113628 100%);
}

.experiences-section .experience-grid .experience-card:hover {
    transform: translateY(-6px);
    border-color: rgba(26, 77, 58, 0.25);
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.12);
}

.experiences-section h2 {
    text-align: center !important;
    display: block !important;
    margin-left: auto !important;
    margin-right: auto !important;
    width: 100%;
}

@keyframes calloutArrowDown {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(6px);
    }
}

@keyframes heroSpin {
    to {
        transform: rotate(360deg);
    }
}


@media (min-width: 1024px) {
    .about-green-layout {
        grid-template-columns: 1.1fr 0.9fr;
        gap: 3rem;
    }

}

@media (max-width: 768px) {
    /* Scale down hero callout text on mobile: "Immerse yourself... / Where Eco is Luxury" */
    .hero-eco-callout .callout-subtitle {
        font-size: 1rem;
        line-height: 1.3;
    }
    .hero-eco-callout .callout-title {
        font-size: 1.2rem;
        line-height: 1.2;
        margin-top: 0.25rem;
    }

    .about-green-image {
        height: auto;
        aspect-ratio: 4 / 3;
    }

    /* Center section titles on mobile: Responsible Travel, Women & Restoration, Signature Journeys */
    .luxury-teaser-section .luxury-copy-col {
        text-align: center !important;
        align-items: center !important;
    }
    .luxury-teaser-section .luxury-heading,
    .luxury-teaser-section h2.luxury-heading {
        text-align: center !important;
        display: block !important;
        width: 100%;
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    /* Center Learn More / CTA buttons in teaser sections on mobile */
    .luxury-teaser-section .luxury-copy-col .inline-flex.self-start {
        align-self: center !important;
    }
}

@media (prefers-reduced-motion: reduce) {
    .scroll-reveal-section {
        opacity: 1 !important;
        transform: none !important;
        transition: none !important;
    }
}

</style>

@section('content')
    <!-- Hero Section -->
        <section id="hero-section" class="hero-section-wrapper relative min-h-screen flex items-center justify-center hero-section-full-viewport">
        <!-- Background Video with Overlay -->
        <div class="hero-video-container z-0">
            <!-- Vimeo Video Background -->
            <div class="video-wrapper">
                    <iframe 
                        id="hero-vimeo-iframe"
                        src="https://player.vimeo.com/video/1058906686?background=1&autoplay=1&loop=1&muted=1&controls=0&playsinline=1"
                        frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen>
                </iframe>
            </div>
            <!-- Overlay for better text readability -->
            <div class="absolute inset-0 bg-[var(--color-forest-green)] opacity-40 z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/60 z-10"></div>
            <!-- Callout inside video container so on mobile it stays over the video -->
            <div class="hero-eco-callout">
                <p class="callout-subtitle">{!! nl2br(e($heroCalloutSection?->subtitle ?: "Immerse yourself in our wild,\nprecious world")) !!}</p>
                <p class="callout-title">{{ $heroCalloutSection?->title ?: 'Where Eco is Luxury' }}</p>
                <a href="#welcome-section" class="callout-arrow-link" aria-label="Scroll to welcome section">
                    <span class="callout-arrow-line" aria-hidden="true"></span>
                    <span class="callout-arrow-line second" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        <div id="hero-video-preloader" class="hero-video-preloader" aria-live="polite" aria-label="Loading background video">
            <div class="hero-video-preloader-spinner" aria-hidden="true"></div>
        </div>
        
        <!-- Content -->
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center text-white">
                @if(filled($heroSection?->title))
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif font-bold mb-6 text-balance leading-tight fade-up-on-scroll">
                    {{ $heroSection->title }}
                </h1>
                @endif

                @if(filled($heroSection?->subtitle))
                <p class="text-xl md:text-2xl mb-10 text-gray-100 max-w-3xl mx-auto text-balance fade-up-on-scroll animation-delay-200">
                    {{ $heroSection->subtitle }}
                </p>
                @endif

                @if(filled($heroSection?->cta_label) && filled($heroSection?->cta_link))
                <div class="flex flex-col sm:flex-row gap-4 justify-center fade-up-on-scroll animation-delay-400">
                    <x-button-primary href="{{ $heroSection->cta_link }}" class="text-lg px-8 py-4 bg-white text-[var(--color-forest-green)] hover:bg-gray-100 border-0">
                        {{ $heroSection->cta_label }}
                    </x-button-primary>
                </div>
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
                <p class="text-lg text-[var(--color-earth-brown)] max-w-3xl mx-auto">
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
                    <h2 class="luxury-heading font-serif font-bold text-[var(--color-forest-green)] mb-0 text-center md:text-left">
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
                    <h2 class="luxury-heading women-restoration-title-tight font-serif font-bold text-[var(--color-forest-green)] mb-0 text-center md:text-left">
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
