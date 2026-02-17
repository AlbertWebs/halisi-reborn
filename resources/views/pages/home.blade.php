@extends('layouts.app')

@section('title', 'Halisi Africa Discoveries - Authentic African Journeys')
@section('description', 'Authentic African Journeys, Designed to Regenerate')

<style>
.video-wrapper {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    height: 100svh;
    height: 100dvh;
    overflow: hidden;
    z-index: 0;
}

.video-wrapper iframe {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100vw;
    height: 56.25vw;
    min-width: 177.78vh;
    min-width: 177.78svh;
    min-width: 177.78dvh;
    min-height: 100vh;
    min-height: 100svh;
    min-height: 100dvh;
    transform: translate(-50%, -50%);
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
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 1.5rem;
}

.experiences-section .experience-grid .experience-card .experience-title {
    color: #fff;
    margin-bottom: 1.25rem;
}

.experiences-section .experience-grid .experience-card .experience-content a:hover {
    color: #2596be !important;
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

.explore-carousel-track {
    display: flex;
    gap: 1.5rem;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    padding-bottom: 0.35rem;
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.explore-carousel-track::-webkit-scrollbar {
    display: none;
}

.explore-carousel-item {
    flex: 0 0 calc(100% - 1rem);
    scroll-snap-align: start;
}

.explore-carousel-btn {
    width: 2.6rem;
    height: 2.6rem;
    border-radius: 9999px;
    border: 1px solid rgba(26, 77, 58, 0.3);
    color: var(--color-forest-green);
    background: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.explore-carousel-btn:hover {
    background: var(--color-forest-green);
    color: #fff;
    border-color: var(--color-forest-green);
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

    .explore-carousel-item {
        flex: 0 0 calc((100% - 3rem) / 3);
    }
}

@media (min-width: 768px) and (max-width: 1023px) {
    .explore-carousel-item {
        flex: 0 0 calc((100% - 1.5rem) / 2);
    }
}

@media (max-width: 768px) {
    .about-green-image {
        height: auto;
        aspect-ratio: 4 / 3;
    }

    .hero-section-wrapper,
    .hero-video-container,
    .video-wrapper {
        height: 100vh !important;
        height: 100svh !important;
        height: 100dvh !important;
        min-height: 100vh !important;
        min-height: 100svh !important;
        min-height: 100dvh !important;
    }

    .video-wrapper iframe {
        width: 177.78vh !important;
        width: 177.78svh !important;
        width: 177.78dvh !important;
        height: 100vh !important;
        height: 100svh !important;
        height: 100dvh !important;
        min-width: 100vw !important;
        min-height: 56.25vw !important;
    }

    .hero-eco-callout {
        left: 50%;
        bottom: 3rem;
    }

    .hero-eco-callout .callout-subtitle {
        font-size: 1.05rem;
    }

    .hero-eco-callout .callout-title {
        font-size: 1.2rem;
    }

    .luxury-body-copy {
        max-width: 100%;
    }
}

@media (prefers-reduced-motion: reduce) {
    .scroll-reveal-section {
        opacity: 1 !important;
        transform: none !important;
        transition: none !important;
    }
}

@media (max-width: 1023px) {
    .luxury-media-frame {
        min-height: 18rem;
        height: auto;
    }
}
</style>

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-wrapper relative min-h-screen flex items-center justify-center" style="width: 100% !important; max-width: none !important; height: 100vh !important; height: 100svh !important; height: 100dvh !important; min-height: 100vh !important; min-height: 100svh !important; min-height: 100dvh !important; position: relative !important; left: 0 !important; right: 0 !important; margin: 0 !important; margin-left: 0 !important; margin-right: 0 !important; padding: 0 !important; overflow: hidden !important;">
        <!-- Background Video with Overlay -->
        <div class="hero-video-container z-0" style="width: 100% !important; height: 100vh !important; height: 100svh !important; height: 100dvh !important; position: absolute !important; inset: 0 !important; margin: 0 !important; padding: 0 !important; overflow: hidden !important;">
            <!-- Vimeo Video Background -->
            <div class="video-wrapper" style="position: absolute !important; inset: 0 !important; width: 100% !important; height: 100vh !important; height: 100svh !important; height: 100dvh !important; overflow: hidden !important; z-index: 0 !important;">
                <iframe 
                    id="hero-vimeo-iframe"
                    src="https://player.vimeo.com/video/1058906686?background=1&autoplay=1&loop=1&muted=1&controls=0&playsinline=1"
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen
                    style="position: absolute !important; top: 50% !important; left: 50% !important; width: 177.78vh !important; width: 177.78svh !important; width: 177.78dvh !important; height: 100vh !important; height: 100svh !important; height: 100dvh !important; min-width: 100vw !important; min-height: 56.25vw !important; transform: translate(-50%, -50%) !important; border: 0 !important; pointer-events: none !important;">
                </iframe>
            </div>
            <!-- Overlay for better text readability -->
            <div class="absolute inset-0 bg-[var(--color-forest-green)] opacity-40 z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/60 z-10"></div>
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

        <div class="hero-eco-callout">
            <p class="callout-subtitle">{!! nl2br(e($heroCalloutSection?->subtitle ?: "Immerse yourself in our wild,\nprecious world")) !!}</p>
            <p class="callout-title">{{ $heroCalloutSection?->title ?: 'Where Eco is Luxury' }}</p>
            <a href="#welcome-section" class="callout-arrow-link" aria-label="Scroll to welcome section">
                <span class="callout-arrow-line" aria-hidden="true"></span>
                <span class="callout-arrow-line second" aria-hidden="true"></span>
            </a>
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
                            <x-button-secondary href="{{ route('journeys.signature-safaris') }}" class="border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent">
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
                            <x-button-secondary href="{{ route('journeys.luxury-retreats') }}" class="border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent">
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
                            <x-button-secondary href="{{ route('journeys.conservation-community') }}" class="border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent">
                                View Impact Journeys
                            </x-button-secondary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 

    <!-- Our 5 Pillars Section -->
    <section class="section-padding bg-white pillars-section">
        @php
            $pillarCulture = $pillarSections['pillar_culture'] ?? null;
            $pillarCommunity = $pillarSections['pillar_community'] ?? null;
            $pillarConservation = $pillarSections['pillar_conservation'] ?? null;
            $pillarChangeAgents = $pillarSections['pillar_change_agents'] ?? null;
            $pillarClimateAction = $pillarSections['pillar_climate_action'] ?? null;

            $pillarCultureIcon = ($pillarCulture && $pillarCulture->image)
                ? '<img src="' . asset('storage/' . $pillarCulture->image) . '" alt="Culture icon" class="w-8 h-8 object-contain" />'
                : '<svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"></path></svg>';
            $pillarCommunityIcon = ($pillarCommunity && $pillarCommunity->image)
                ? '<img src="' . asset('storage/' . $pillarCommunity->image) . '" alt="Community icon" class="w-8 h-8 object-contain" />'
                : '<svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2a3 3 0 00-5.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>';
            $pillarConservationIcon = ($pillarConservation && $pillarConservation->image)
                ? '<img src="' . asset('storage/' . $pillarConservation->image) . '" alt="Conservation icon" class="w-8 h-8 object-contain" />'
                : '<svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            $pillarChangeAgentsIcon = ($pillarChangeAgents && $pillarChangeAgents->image)
                ? '<img src="' . asset('storage/' . $pillarChangeAgents->image) . '" alt="Change agents icon" class="w-8 h-8 object-contain" />'
                : '<svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>';
            $pillarClimateActionIcon = ($pillarClimateAction && $pillarClimateAction->image)
                ? '<img src="' . asset('storage/' . $pillarClimateAction->image) . '" alt="Climate action icon" class="w-8 h-8 object-contain" />'
                : '<svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m9-9H3"></path></svg>';
        @endphp
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-center text-[var(--color-forest-green)] mb-16">
                Our 5 Pillars
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-8 pillars-grid">
                <x-pillar-card 
                    class="pillar-card-eq"
                    :icon="$pillarCultureIcon"
                    title="{{ $pillarCulture?->title ?: 'Culture' }}"
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ $pillarCulture?->cta_link ?: route('impact.responsible-travel') }}" class="mt-4 text-sm mx-auto">
                            {{ $pillarCulture?->cta_label ?: 'Learn More' }}
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    class="pillar-card-eq"
                    :icon="$pillarCommunityIcon"
                    title="{{ $pillarCommunity?->title ?: 'Community' }}"
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ $pillarCommunity?->cta_link ?: route('impact.climate-community') }}" class="mt-4 text-sm mx-auto">
                            {{ $pillarCommunity?->cta_label ?: 'Learn More' }}
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    class="pillar-card-eq"
                    :icon="$pillarConservationIcon"
                    title="{{ $pillarConservation?->title ?: 'Conservation' }}"
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ $pillarConservation?->cta_link ?: route('impact.responsible-travel') }}" class="mt-4 text-sm mx-auto">
                            {{ $pillarConservation?->cta_label ?: 'Learn More' }}
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    class="pillar-card-eq"
                    :icon="$pillarChangeAgentsIcon"
                    title="{{ $pillarChangeAgents?->title ?: 'Change Agents' }}"
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ $pillarChangeAgents?->cta_link ?: route('trust.index') }}" class="mt-4 text-sm mx-auto">
                            {{ $pillarChangeAgents?->cta_label ?: 'Learn More' }}
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    class="pillar-card-eq"
                    :icon="$pillarClimateActionIcon"
                    title="{{ $pillarClimateAction?->title ?: 'Climate Action' }}"
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ $pillarClimateAction?->cta_link ?: route('impact.climate-community') }}" class="mt-4 text-sm mx-auto">
                            {{ $pillarClimateAction?->cta_label ?: 'Learn More' }}
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
            </div>
        </div>
    </section>

    

    <!-- Explore Africa Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)]">
                    Explore Africa
                </h2>
                <div class="hidden md:flex items-center gap-3">
                    <button type="button" class="explore-carousel-btn" data-carousel-target="explore-africa-carousel" data-carousel-dir="prev" aria-label="Previous countries">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button type="button" class="explore-carousel-btn" data-carousel-target="explore-africa-carousel" data-carousel-dir="next" aria-label="Next countries">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
            <div id="explore-africa-carousel" class="explore-carousel-track">
                <div class="explore-carousel-item"><x-country-card name="Kenya" slug="kenya" /></div>
                <div class="explore-carousel-item"><x-country-card name="Uganda" slug="uganda" /></div>
                <div class="explore-carousel-item"><x-country-card name="Tanzania" slug="tanzania" /></div>
                <div class="explore-carousel-item"><x-country-card name="Zambia" slug="zambia" /></div>
                <div class="explore-carousel-item"><x-country-card name="Zimbabwe" slug="zimbabwe" /></div>
                <div class="explore-carousel-item"><x-country-card name="Botswana" slug="botswana" /></div>
                <div class="explore-carousel-item"><x-country-card name="Namibia" slug="namibia" /></div>
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

        const exploreCarousel = document.getElementById('explore-africa-carousel');
        let exploreAutoSlideTimer = null;

        function scrollExploreCarousel(track, direction = 'next') {
            if (!track) return;
            const scrollAmount = Math.max(track.clientWidth * 0.9, 280);
            const nextLeft = direction === 'next'
                ? track.scrollLeft + scrollAmount
                : track.scrollLeft - scrollAmount;

            const maxLeft = track.scrollWidth - track.clientWidth;

            if (direction === 'next' && nextLeft >= maxLeft - 4) {
                track.scrollTo({ left: 0, behavior: 'smooth' });
                return;
            }

            if (direction === 'prev' && nextLeft <= 0) {
                track.scrollTo({ left: maxLeft, behavior: 'smooth' });
                return;
            }

            track.scrollBy({
                left: direction === 'next' ? scrollAmount : -scrollAmount,
                behavior: 'smooth'
            });
        }

        function startExploreAutoSlide() {
            if (!exploreCarousel || exploreAutoSlideTimer) return;
            exploreAutoSlideTimer = setInterval(() => {
                scrollExploreCarousel(exploreCarousel, 'next');
            }, 4200);
        }

        function stopExploreAutoSlide() {
            if (!exploreAutoSlideTimer) return;
            clearInterval(exploreAutoSlideTimer);
            exploreAutoSlideTimer = null;
        }

        document.querySelectorAll('[data-carousel-target]').forEach((button) => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-carousel-target');
                const direction = button.getAttribute('data-carousel-dir');
                const track = document.getElementById(targetId);
                if (!track) return;
                stopExploreAutoSlide();
                scrollExploreCarousel(track, direction);
                startExploreAutoSlide();
            });
        });

        if (exploreCarousel) {
            exploreCarousel.addEventListener('mouseenter', stopExploreAutoSlide);
            exploreCarousel.addEventListener('mouseleave', startExploreAutoSlide);
            exploreCarousel.addEventListener('touchstart', stopExploreAutoSlide, { passive: true });
            exploreCarousel.addEventListener('touchend', startExploreAutoSlide, { passive: true });
            exploreCarousel.addEventListener('focusin', stopExploreAutoSlide);
            exploreCarousel.addEventListener('focusout', startExploreAutoSlide);

            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    stopExploreAutoSlide();
                } else {
                    startExploreAutoSlide();
                }
            });

            startExploreAutoSlide();
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
        });
    </script>


    <!-- Responsible Travel Teaser Section -->
    <section class="luxury-teaser-section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 luxury-equal-grid">
                <div class="luxury-copy-col">
                    <h2 class="luxury-heading font-serif font-bold text-[var(--color-forest-green)] mb-0">
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
                    <h2 class="luxury-heading women-restoration-title-tight font-serif font-bold text-[var(--color-forest-green)] mb-0">
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
            <h2 class="luxury-heading font-serif font-bold text-center text-[var(--color-forest-green)] mb-14">
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
            <x-button-primary href="{{ route('contact.index') }}" class="bg-white text-[var(--color-forest-green)] hover:bg-gray-100 text-lg md:text-xl px-10 md:px-12 py-5 border-0 tracking-wide">
                Start Your Journey
            </x-button-primary>
        </div>
    </section>
@endsection
