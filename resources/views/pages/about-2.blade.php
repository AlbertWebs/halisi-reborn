@extends('layouts.app')

@section('title', $page?->meta_title ?: 'About Halisi Africa - Our Story & Philosophy')
@section('description', $page?->meta_description ?: 'Halisi Africa Discoveries: tour planning that empowers women and protects the environment—authentic African journeys.')

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

        $aboutHeroImage = $resolvePageImage($page?->hero_image);
        $aboutContentImage1 = $resolvePageImage($page?->content_image_1);
        $aboutContentImage2 = $resolvePageImage($page?->content_image_2);
    @endphp

    <!-- Hero Section -->
    <section class="relative min-h-[60vh] flex items-center justify-center bg-[var(--color-forest-green)] text-white overflow-hidden">
        @if($aboutHeroImage)
            <img src="{{ $aboutHeroImage }}" alt="{{ $page?->hero_title ?: 'About Halisi Africa' }}" class="absolute inset-0 w-full h-full object-cover" loading="eager">
            <div class="absolute inset-0 bg-black/45"></div>
        @else
            {{-- Hero image placeholder: gradient + pattern (upload hero in admin to replace) --}}
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-earth-brown)]/90 via-[var(--color-forest-green)] to-[var(--color-earth-brown)]/80" aria-hidden="true"></div>
            <div class="absolute inset-0 opacity-[0.12] pointer-events-none" style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M40 40m-38 0a38 38 0 1 1 76 0a38 38 0 1 1-76 0'/%3E%3C/g%3E%3C/svg%3E&quot;); background-size: 80px 80px;" aria-hidden="true"></div>
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-[0.15]" aria-hidden="true">
                <svg class="w-32 h-32 md:w-40 md:h-40 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.75" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/20" aria-hidden="true"></div>
        @endif
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                {{ $page?->hero_title ?: 'About Halisi Africa' }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-2xl mx-auto">
                {{ $page?->hero_subtext ?: 'Travel that empowers women · Journeys that protect the land' }}
            </p>
        </div>
    </section>

    <x-mission-vision />

    <!-- Our story: full-width image, then stacked cards + text (no side-by-side image/text) -->
    <section class="section-padding bg-white pb-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)]">
                    Our story
                </h2>
            </div>

            <div class="rounded-xl overflow-hidden shadow-lg border border-[var(--color-sand-beige)] mb-10 js-scroll">
                @if($aboutContentImage1)
                    <img src="{{ $aboutContentImage1 }}" alt="About Halisi story image" class="w-full aspect-[16/9] sm:aspect-[21/9] md:h-[min(420px,50vh)] md:aspect-auto object-cover" loading="lazy">
                @else
                    <x-about-image-placeholder label="Our story" />
                @endif
            </div>

            <div class="space-y-8 max-w-3xl mx-auto">
                <div class="space-y-4 js-scroll-stagger">
                    <div class="flex gap-4 items-center p-4 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/70">
                        <div class="w-12 h-12 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center shrink-0" aria-hidden="true">
                            <span class="text-lg font-serif font-bold text-[var(--color-forest-green)]">H</span>
                        </div>
                        <div>
                            <p class="font-serif font-semibold text-[var(--color-forest-green)]">Halisi</p>
                            <p class="text-sm text-[var(--color-earth-brown)]">Means <em>authentic</em> in Swahili.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-center p-4 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/70">
                        <div class="w-12 h-12 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center shrink-0 text-[var(--color-forest-green)]" aria-hidden="true">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-serif font-semibold text-[var(--color-forest-green)]">Where</p>
                            <p class="text-sm text-[var(--color-earth-brown)]">East &amp; Southern Africa.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-center p-4 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/70">
                        <div class="w-12 h-12 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center shrink-0 text-[var(--color-forest-green)]" aria-hidden="true">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-serif font-semibold text-[var(--color-forest-green)]">Focus</p>
                            <p class="text-sm text-[var(--color-earth-brown)]">Women · climate · hosts on their terms.</p>
                        </div>
                    </div>
                </div>
                <p class="text-lg md:text-xl text-[var(--color-earth-brown)] leading-snug font-serif text-balance js-scroll js-scroll-fade">
                    Tour planning with the same mission we started with: <strong class="text-[var(--color-forest-green)]">women first</strong>, <strong class="text-[var(--color-forest-green)]">environment next</strong>, real partnerships—not marketing filler.
                </p>
            </div>
        </div>
    </section>

 

    <!-- Focus: graphics-first, minimal copy -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-2">
                    How we work
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 js-scroll-stagger">
                <div class="bg-white p-8 rounded-2xl border border-[var(--color-sand-beige)] text-center shadow-sm">
                    <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center">
                        <svg class="w-9 h-9 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-serif font-bold text-[var(--color-forest-green)] mb-2">Women first</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-snug">Co-ops · fair pay · women lead.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl border border-[var(--color-sand-beige)] text-center shadow-sm">
                    <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center">
                        <svg class="w-9 h-9 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-serif font-bold text-[var(--color-forest-green)] mb-2">Land &amp; climate</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-snug">Restore · protect · lighter footprint.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl border border-[var(--color-sand-beige)] text-center shadow-sm">
                    <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-[var(--color-sand-beige)] flex items-center justify-center">
                        <svg class="w-9 h-9 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-serif font-bold text-[var(--color-forest-green)] mb-2">Real places</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-snug">Hosts set the tone. No script.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-8 bg-[var(--color-off-white)]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl overflow-hidden shadow-lg border border-[var(--color-sand-beige)] js-scroll">
                @if($aboutContentImage2)
                    <img src="{{ $aboutContentImage2 }}" alt="About Halisi philosophy image" class="w-full h-[220px] sm:h-[300px] md:h-[380px] object-cover" loading="lazy">
                @else
                    <x-about-image-placeholder label="People &amp; places" />
                @endif
            </div>
        </div>
    </section>

    @php
        $aboutGallery = $page?->galleryImages ?? collect();
    @endphp
    <section class="section-padding bg-white border-t border-[var(--color-sand-beige)]/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 md:mb-12 js-scroll">
                <p class="text-xs uppercase tracking-[0.2em] text-[var(--color-accent-gold)] font-bold mb-3">Gallery</p>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)]">
                    Moments &amp; places
                </h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-6 js-scroll-stagger">
                @forelse($aboutGallery as $galleryImg)
                    <div class="rounded-xl overflow-hidden shadow-sm border border-[var(--color-sand-beige)]/60 aspect-[4/3] bg-[var(--color-off-white)]">
                        <img
                            src="{{ asset('storage/' . $galleryImg->image) }}"
                            alt=""
                            class="w-full h-full object-cover hover:scale-[1.03] transition-transform duration-300"
                            loading="lazy"
                        >
                    </div>
                @empty
                    @foreach(range(1, 4) as $slot)
                        <x-about-image-placeholder size="gallery" :label="'Gallery ' . $slot" class="shadow-sm" />
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- The 5 Regenerative Pillars - Expanded -->
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)]">
                    Five pillars
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 js-scroll-stagger">
                <div class="text-center">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">Culture</h3>
                    <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Heritage, not performance.</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">Community</h3>
                    <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Local income · women-led.</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">Conservation</h3>
                    <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Wildlife · habitat · trips fund it.</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">Change agents</h3>
                    <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Doers on the ground.</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">Climate</h3>
                    <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Less carbon · offsets · nature fixes.</p>
                </div>
            </div>
        </div>
    </section>

  

    <!-- Why us — icon grid, short lines -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)]">
                    Why us
                </h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 js-scroll-stagger">
                <div class="flex gap-4 p-5 rounded-xl bg-white border border-[var(--color-sand-beige)]/80">
                    <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)]" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-[var(--color-forest-green)] mb-1">Custom trips</h3>
                        <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Your pace, your brief.</p>
                    </div>
                </div>
                <div class="flex gap-4 p-5 rounded-xl bg-white border border-[var(--color-sand-beige)]/80">
                    <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)]" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-[var(--color-forest-green)] mb-1">Clear impact</h3>
                        <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Projects tied to where you go.</p>
                    </div>
                </div>
                <div class="flex gap-4 p-5 rounded-xl bg-white border border-[var(--color-sand-beige)]/80">
                    <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)]" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-[var(--color-forest-green)] mb-1">On-the-ground team</h3>
                        <p class="text-xs text-[var(--color-earth-brown)] leading-snug">We’ve lived the routes.</p>
                    </div>
                </div>
                <div class="flex gap-4 p-5 rounded-xl bg-white border border-[var(--color-sand-beige)]/80">
                    <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)]" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-[var(--color-forest-green)] mb-1">Carbon in the plan</h3>
                        <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Offsets + nature projects.</p>
                    </div>
                </div>
                <div class="flex gap-4 p-5 rounded-xl bg-white border border-[var(--color-sand-beige)]/80 sm:col-span-2 lg:col-span-1">
                    <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)]" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-[var(--color-forest-green)] mb-1">Comfort, no guilt trip</h3>
                        <p class="text-xs text-[var(--color-earth-brown)] leading-snug">Good beds · same values.</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-center js-scroll">
                <x-button-primary href="{{ route('contact.index') }}">
                    Design Your Journey
                </x-button-primary>
            </div>
        </div>
    </section>
@endsection
