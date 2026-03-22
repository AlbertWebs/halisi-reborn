@extends('layouts.app')

@section('title', $page?->meta_title ?: 'Responsible & Regenerative Travel - Halisi Africa')
@section('description', $page?->meta_description ?: 'How we travel: women’s empowerment, environmental sustainability, and lower-impact journeys across Africa.')

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
                {{ $page?->hero_subtext ?: 'Same mission: empower women · protect the environment' }}
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
                Travel that does more
            </h2>
            </div>
            <div class="js-scroll grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10 max-w-3xl mx-auto">
                <div class="flex flex-col items-center text-center p-5 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/60">
                    <div class="w-11 h-11 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-2" aria-hidden="true">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z"/></svg>
                    </div>
                    <p class="text-sm font-semibold text-[var(--color-forest-green)]">Women-led</p>
                    <p class="text-xs text-[var(--color-earth-brown)] mt-1">Income &amp; leadership</p>
                </div>
                <div class="flex flex-col items-center text-center p-5 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/60">
                    <div class="w-11 h-11 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-2" aria-hidden="true">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-sm font-semibold text-[var(--color-forest-green)]">Habitat</p>
                    <p class="text-xs text-[var(--color-earth-brown)] mt-1">Land &amp; climate</p>
                </div>
                <div class="flex flex-col items-center text-center p-5 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/60 sm:col-span-1">
                    <div class="w-11 h-11 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-2" aria-hidden="true">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <p class="text-sm font-semibold text-[var(--color-forest-green)]">Fair visits</p>
                    <p class="text-xs text-[var(--color-earth-brown)] mt-1">Respect, not performance</p>
                </div>
            </div>

            <div class="js-scroll impact-quote bg-[var(--color-off-white)] p-6 md:p-8 rounded-r-xl my-10 shadow-sm max-w-2xl mx-auto">
                <blockquote class="text-base md:text-lg font-serif italic text-[var(--color-forest-green)] leading-snug text-center">
                    Exceptional travel that empowers women and protects the natural world.
                </blockquote>
                <cite class="block text-center text-xs text-[var(--color-earth-brown)] not-italic mt-3">— Mission</cite>
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
                    On the ground
                </h2>
            </div>
            
            <div class="js-scroll-stagger grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-forest-green)]/10 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Community-led
                    </h3>
                    <ul class="list-none space-y-2.5 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Local-owned stays where we can</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Guides &amp; staff from the area</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Benefits agreed with communities</li>
                    </ul>
                </div>
                
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-forest-green)]/10 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Wildlife
                    </h3>
                    <ul class="list-none space-y-2.5 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Space for animals first</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Anti-poaching we can fund</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> No captive “selfies”</li>
                    </ul>
                </div>
                
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-forest-green)]/10 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Culture
                    </h3>
                    <ul class="list-none space-y-2.5 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Visits only when hosts agree</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Fair pay for guides</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Guests briefed on respect</li>
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
                    Carbon
                </h2>
            </div>
            
            <p class="js-scroll text-sm md:text-base text-[var(--color-earth-brown)] mb-10 max-w-xl mx-auto text-center leading-snug">
                Trips are planned <strong class="text-[var(--color-forest-green)]">carbon-neutral</strong>: cut waste first, then verified offsets.
            </p>
            
            <!-- Impact Stats -->
            <div class="js-scroll-stagger grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
                <div class="impact-card text-center bg-[var(--color-off-white)] p-8 rounded-xl border border-[var(--color-sand-beige)]/40">
                    <div class="text-4xl md:text-5xl font-serif font-bold text-[var(--color-forest-green)] mb-2">100%</div>
                    <div class="text-xs sm:text-sm uppercase tracking-wide text-[var(--color-earth-brown)]">Neutral trips</div>
                </div>
                <div class="impact-card text-center bg-[var(--color-off-white)] p-8 rounded-xl border border-[var(--color-sand-beige)]/40">
                    <div class="text-4xl md:text-5xl font-serif font-bold text-[var(--color-forest-green)] mb-2">150%</div>
                    <div class="text-xs sm:text-sm uppercase tracking-wide text-[var(--color-earth-brown)]">Offset aim</div>
                </div>
                <div class="impact-card text-center bg-[var(--color-off-white)] p-8 rounded-xl border border-[var(--color-sand-beige)]/40">
                    <div class="text-4xl md:text-5xl font-serif font-bold text-[var(--color-forest-green)] mb-2">Verified</div>
                    <div class="text-xs sm:text-sm uppercase tracking-wide text-[var(--color-earth-brown)]">Gold Standard</div>
                </div>
            </div>
            
            <div class="js-scroll impact-card bg-[var(--color-off-white)] p-6 md:p-8 rounded-xl border border-[var(--color-sand-beige)]/50 shadow-sm">
                <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-6 text-center md:text-left">Carbon — 3 steps</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-[var(--color-earth-brown)]">
                    <div class="flex gap-3 items-start">
                        <span class="w-10 h-10 rounded-lg bg-[var(--color-forest-green)]/10 flex items-center justify-center text-[var(--color-forest-green)] shrink-0 font-bold text-sm" aria-hidden="true">1</span>
                        <div>
                            <span class="text-[var(--color-accent-gold)] font-bold text-xs uppercase tracking-wide">Reduce</span>
                            <p class="text-xs leading-snug mt-1">Smarter routing · less waste · greener stays where possible.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="w-10 h-10 rounded-lg bg-[var(--color-forest-green)]/10 flex items-center justify-center text-[var(--color-forest-green)] shrink-0 font-bold text-sm" aria-hidden="true">2</span>
                        <div>
                            <span class="text-[var(--color-accent-gold)] font-bold text-xs uppercase tracking-wide">Offset</span>
                            <p class="text-xs leading-snug mt-1">Gold Standard–type projects for what’s left.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="w-10 h-10 rounded-lg bg-[var(--color-forest-green)]/10 flex items-center justify-center text-[var(--color-forest-green)] shrink-0 font-bold text-sm" aria-hidden="true">3</span>
                        <div>
                            <span class="text-[var(--color-accent-gold)] font-bold text-xs uppercase tracking-wide">Restore</span>
                            <p class="text-xs leading-snug mt-1">Mangroves, trees, grasslands—carbon + people.</p>
                        </div>
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
                    Land &amp; water
                </h2>
            </div>
            
            
            <div class="js-scroll-stagger grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="impact-card bg-white p-6 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-10 h-10 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-3" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-2">Mangroves</h3>
                    <p class="text-xs text-[var(--color-earth-brown)] leading-snug mb-3">Heavy carbon store · women’s co-ops on the coast.</p>
                    <div class="p-3 bg-[var(--color-off-white)] rounded-lg inline-flex flex-wrap items-baseline gap-2">
                        <span class="text-xl font-serif font-bold text-[var(--color-forest-green)]">1:1</span>
                        <span class="text-xs text-[var(--color-earth-brown)]">Guest · tree planted</span>
                    </div>
                </div>

                <div class="impact-card bg-white p-6 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-10 h-10 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-3" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-2">Trees</h3>
                    <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Community-led planting · corridors for wildlife.</p>
                </div>

                <div class="impact-card bg-white p-6 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-10 h-10 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-3" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-2">Grasslands</h3>
                    <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Grazing · fire where it helps · carbon in soil.</p>
                </div>

                <div class="impact-card bg-white p-6 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-10 h-10 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-3" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-2">Farms</h3>
                    <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Tougher crops · less waste · better local food.</p>
                </div>
            </div>
            
            <div class="js-scroll mt-14 text-center">
                <a href="{{ route('impact.climate-community') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-[var(--radius-button)] border border-[var(--color-forest-green)] bg-[var(--color-forest-green)] text-white font-semibold uppercase tracking-[0.04em] hover:bg-[var(--color-forest-green)]/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)] focus-visible:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Climate &amp; community
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
