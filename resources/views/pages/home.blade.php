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

.pillars-section .pillar-card-eq .mt-6 {
    margin-top: auto;
    display: flex;
    justify-content: center;
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

@media (min-width: 1024px) {
    .about-green-layout {
        grid-template-columns: 1.1fr 0.9fr;
        gap: 3rem;
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

    <x-section-divider />

    <!-- Our 5 Pillars Section -->
    <section class="section-padding bg-white pillars-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-center text-[var(--color-forest-green)] mb-16">
                Our 5 Pillars
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-8 pillars-grid">
                <x-pillar-card 
                    class="pillar-card-eq"
                    title="Culture" 
                    description="Honoring and supporting traditional knowledge and cultural heritage."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('impact.responsible-travel') }}" class="mt-4 text-sm mx-auto">
                            Learn More
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    class="pillar-card-eq"
                    title="Community" 
                    description="Investing in local leadership and sustainable livelihoods that benefit communities."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('impact.climate-community') }}" class="mt-4 text-sm mx-auto">
                            Learn More
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    class="pillar-card-eq"
                    title="Conservation" 
                    description="Supporting projects that restore degraded landscapes and protect biodiversity."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('impact.responsible-travel') }}" class="mt-4 text-sm mx-auto">
                            Learn More
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    class="pillar-card-eq"
                    title="Change Agents" 
                    description="Empowering local leaders and initiatives that drive positive transformation."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('trust.index') }}" class="mt-4 text-sm mx-auto">
                            Learn More
                        </x-button-secondary>
                    </x-slot>
                </x-pillar-card>
                <x-pillar-card 
                    class="pillar-card-eq"
                    title="Climate Action" 
                    description="Carbon-neutral journeys and support for climate resilience initiatives."
                >
                    <x-slot name="button">
                        <x-button-secondary href="{{ route('impact.climate-community') }}" class="mt-4 text-sm mx-auto">
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
