@extends('layouts.app')

@section('title', $page?->meta_title ?: 'Responsible & Regenerative Travel - Halisi Africa')
@section('description', $page?->meta_description ?: 'Learn how Halisi Africa creates regenerative travel experiences that restore ecosystems, support communities, and address climate change through nature-based solutions.')

@push('styles')
<style>
    .impact-section-label { letter-spacing: 0.2em; }
    .impact-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
    .impact-card:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(26, 77, 58, 0.12); }
    .impact-quote { border-left: 4px solid var(--color-accent-gold); }
</style>
@endpush

@section('content')
    @php
        $resolvePageImage = function (?string $image): ?string {
            if (!filled($image)) {
                return null;
            }
            if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
                return $image;
            }
            if (str_starts_with($image, '/storage/')) {
                return asset(ltrim($image, '/'));
            }
            if (str_starts_with($image, 'storage/')) {
                return asset($image);
            }
            return asset('storage/' . ltrim($image, '/'));
        };

        $impactHeroImage = $resolvePageImage($page?->hero_image);
        $impactContentImage1 = $resolvePageImage($page?->content_image_1);
        $impactContentImage2 = $resolvePageImage($page?->content_image_2);
    @endphp

    <!-- Hero Section -->
    <section class="relative min-h-[70vh] flex items-center justify-center bg-[var(--color-forest-green)] text-white overflow-hidden">
        @if($impactHeroImage)
            <img src="{{ $impactHeroImage }}" alt="{{ $page?->hero_title ?: 'Responsible & Regenerative Travel' }}" class="absolute inset-0 w-full h-full object-cover" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/30"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)]/80 to-[var(--color-forest-green)]"></div>
        @endif
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-4">Our commitment</p>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance drop-shadow-sm">
                {{ $page?->hero_title ?: 'Responsible & Regenerative Travel' }}
            </h1>
            <p class="text-xl md:text-2xl text-white/95 max-w-2xl mx-auto leading-relaxed">
                {{ $page?->hero_subtext ?: 'Our commitment to climate-positive travel and ecosystem restoration' }}
            </p>
        </div>
    </section>

    <!-- What Regenerative Tourism Means Section -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="js-scroll mb-8" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Home
                </a>
            </nav>
            <div class="js-scroll">
            <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3">Impact</p>
            <div class="w-16 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8 text-center">
                What Regenerative Tourism Means at Halisi
            </h2>
            </div>
            <div class="js-scroll js-scroll-fade prose prose-lg max-w-none text-[var(--color-earth-brown)] mb-10">
                <p class="text-lg leading-relaxed mb-6">
                    Regenerative tourism goes beyond sustainability. While sustainable tourism aims to minimize negative impact, 
                    regenerative tourism actively restores and improves the ecosystems and communities it touches. At Halisi Africa, 
                    every journey is designed to leave destinations better than we found them.
                </p>
                <p class="text-lg leading-relaxed mb-6">
                    This means direct support for conservation projects, community-led initiatives, and nature-based solutions 
                    that address climate change. It means travelers become active participants in restoration, not passive observers. 
                    It means measurable positive impact that extends far beyond the duration of a journey.
                </p>
            </div>
            
            <!-- Pull Quote -->
            <div class="js-scroll impact-quote bg-[var(--color-off-white)] p-8 md:p-10 rounded-r-xl my-12 shadow-sm">
                <blockquote class="text-2xl md:text-3xl font-serif italic text-[var(--color-forest-green)] mb-4 leading-snug">
                    "Travel should regenerate, not just preserve. Every journey must leave more than footprints—it must leave legacy."
                </blockquote>
                <cite class="text-sm text-[var(--color-earth-brown)] not-italic">— Halisi Africa Philosophy</cite>
            </div>
        </div>
    </section>

    @if($impactContentImage1)
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="js-scroll rounded-2xl overflow-hidden shadow-md border border-[var(--color-sand-beige)]/50">
                    <img src="{{ $impactContentImage1 }}" alt="Responsible travel" class="w-full aspect-[21/9] sm:aspect-[3/1] object-cover" loading="lazy">
                </div>
            </div>
        </section>
    @endif

    

    <!-- Responsible Travel Practices Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll text-center mb-12">
                <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3">Practices</p>
                <div class="w-16 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)]">
                    Responsible Travel Practices
                </h2>
            </div>
            
            <div class="js-scroll-stagger grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-forest-green)]/10 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Community-Led Partnerships
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4 text-sm md:text-base">
                        We partner exclusively with community-led initiatives and locally-owned accommodations so tourism revenue stays in communities and supports local decision-making.
                    </p>
                    <ul class="list-none space-y-2 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-1">•</span> 70%+ accommodation revenue to local ownership</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-1">•</span> Local guides and staff</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-1">•</span> Community benefit agreements</li>
                    </ul>
                </div>
                
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-forest-green)]/10 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Wildlife Protection Standards
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4 text-sm md:text-base">
                        Strict wildlife viewing guidelines prioritize animal welfare and ecosystem health. All experiences minimize disturbance and support conservation.
                    </p>
                    <ul class="list-none space-y-2 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-1">•</span> Safe distances at all times</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-1">•</span> Anti-poaching support</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-1">•</span> No captive wildlife experiences</li>
                    </ul>
                </div>
                
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-forest-green)]/10 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Cultural Respect & Authenticity
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4 text-sm md:text-base">
                        Authentic cultural exchanges that respect local traditions, support preservation, and ensure communities benefit from sharing their heritage.
                    </p>
                    <ul class="list-none space-y-2 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-1">•</span> Community consent in all experiences</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-1">•</span> Fair compensation for guides</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-1">•</span> Education on respectful engagement</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @if($impactContentImage2)
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="js-scroll rounded-2xl overflow-hidden shadow-md border border-[var(--color-sand-beige)]/50">
                    <img src="{{ $impactContentImage2 }}" alt="Climate action" class="w-full aspect-[21/9] sm:aspect-[3/1] object-cover" loading="lazy">
                </div>
            </div>
        </section>
    @endif



    <!-- Carbon Conscious Travel Section -->
    <section class="section-padding bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll text-center mb-10">
                <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3">Carbon</p>
                <div class="w-16 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8">
                    Carbon Conscious Travel & Offsetting
                </h2>
            </div>
            
            <p class="js-scroll text-lg text-[var(--color-earth-brown)] leading-relaxed mb-10 max-w-2xl mx-auto text-center">
                We recognize that travel has a carbon footprint. Every Halisi Africa journey is carbon-neutral through reduction, efficiency, and verified offset programs.
            </p>
            
            <!-- Impact Stats -->
            <div class="js-scroll-stagger grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
                <div class="impact-card text-center bg-[var(--color-off-white)] p-8 rounded-xl border border-[var(--color-sand-beige)]/40">
                    <div class="text-4xl md:text-5xl font-serif font-bold text-[var(--color-forest-green)] mb-2">100%</div>
                    <div class="text-sm uppercase tracking-wide text-[var(--color-earth-brown)]">Carbon Neutral Journeys</div>
                </div>
                <div class="impact-card text-center bg-[var(--color-off-white)] p-8 rounded-xl border border-[var(--color-sand-beige)]/40">
                    <div class="text-4xl md:text-5xl font-serif font-bold text-[var(--color-forest-green)] mb-2">150%</div>
                    <div class="text-sm uppercase tracking-wide text-[var(--color-earth-brown)]">Offset Target (Net Positive)</div>
                </div>
                <div class="impact-card text-center bg-[var(--color-off-white)] p-8 rounded-xl border border-[var(--color-sand-beige)]/40">
                    <div class="text-4xl md:text-5xl font-serif font-bold text-[var(--color-forest-green)] mb-2">Verified</div>
                    <div class="text-sm uppercase tracking-wide text-[var(--color-earth-brown)]">Gold Standard Offsets</div>
                </div>
            </div>
            
            <div class="js-scroll impact-card bg-[var(--color-off-white)] p-8 md:p-10 rounded-xl border border-[var(--color-sand-beige)]/50 shadow-sm">
                <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-6">
                    Our Carbon Strategy
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-[var(--color-earth-brown)]">
                    <div class="flex flex-col">
                        <span class="text-[var(--color-accent-gold)] font-bold text-sm uppercase tracking-wide mb-2">Reduce</span>
                        <p class="text-sm leading-relaxed">Minimize emissions through efficient routing, ground transport where possible, and partnerships with accommodations that prioritize renewable energy.</p>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[var(--color-accent-gold)] font-bold text-sm uppercase tracking-wide mb-2">Offset</span>
                        <p class="text-sm leading-relaxed">All remaining emissions offset through Gold Standard verified projects: reforestation, renewable energy, and community-based carbon reduction.</p>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[var(--color-accent-gold)] font-bold text-sm uppercase tracking-wide mb-2">Restore</span>
                        <p class="text-sm leading-relaxed">Beyond offsetting: we support nature-based solutions that sequester carbon while restoring ecosystems and supporting communities.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <!-- Climate Action Through Nature-Based Solutions Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll text-center mb-12">
                <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3">Nature-based solutions</p>
                <div class="w-16 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8">
                    Climate Action Through Nature-Based Solutions
                </h2>
            </div>
            
            <p class="js-scroll text-lg text-[var(--color-earth-brown)] leading-relaxed mb-12 max-w-2xl mx-auto text-center">
                Nature-based solutions harness the power of ecosystems to address climate change while providing co-benefits for biodiversity and communities. We integrate these directly into our travel experiences.
            </p>
            
            <div class="js-scroll-stagger grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">
                        Mangrove Restoration
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4 text-sm">
                        Mangroves are among the most effective carbon sinks on Earth. Our "One Tourist = One Mangrove" program supports restoration projects led by women's cooperatives in coastal communities.
                    </p>
                    <div class="mt-4 p-4 bg-[var(--color-off-white)] rounded-lg inline-block">
                        <span class="text-2xl font-serif font-bold text-[var(--color-forest-green)]">1:1</span>
                        <span class="text-sm text-[var(--color-earth-brown)] ml-2">One Tourist = One Mangrove Planted</span>
                    </div>
                </div>
                
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">
                        Reforestation & Afforestation
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed text-sm">
                        We support community-led reforestation that restores degraded landscapes, creates wildlife corridors, and provides sustainable livelihoods through agroforestry and forest products.
                    </p>
                </div>
                
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">
                        Grassland & Savanna Restoration
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed text-sm">
                        We support initiatives that restore grasslands and savannas through sustainable grazing, controlled burns, and community-led conservation—critical for carbon and wildlife.
                    </p>
                </div>
                
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">
                        Climate-Resilient Agriculture
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed text-sm">
                        We partner with community initiatives that promote climate-resilient agricultural practices, reducing emissions while improving food security and local economies.
                    </p>
                </div>
            </div>
            
            <div class="js-scroll mt-14 text-center">
                <a href="{{ route('impact.climate-community') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-[var(--color-forest-green)] text-white font-semibold uppercase tracking-wide rounded-xl hover:bg-[var(--color-forest-green)]/90 focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:ring-offset-2 transition-all shadow-lg hover:shadow-xl">
                    Learn More About Climate & Community Impact
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
