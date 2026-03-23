@extends('layouts.app-home')

@section('title', 'Halisi Africa Discoveries - Women-led impact & African journeys')
@section('description', 'Tour planning that empowers women and protects the environment. Authentic journeys across Africa.')


@include('pages.homecss')


@section('content')
    <!-- Hero Section -->
    <section id="hero-section"
        class="hero-section-wrapper relative min-h-screen flex items-center justify-center hero-section-full-viewport">
        <x-home-hero-background
            :use-carousel="$useHeroCarousel"
            :slides="$heroCarouselSlides"
            :vimeo-video-id="$heroVimeoVideoId"
            :carousel-interval-ms="$heroCarouselIntervalMs"
            :hero-callout-section="$heroCalloutSection"
        />
        @unless($useHeroCarousel)
            <div id="hero-video-preloader" class="hero-video-preloader" aria-live="polite"
                aria-label="Loading background video">
                <div class="hero-video-preloader-spinner" aria-hidden="true"></div>
            </div>
        @endunless
        <!-- Content -->
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
                                    class="text-lg px-8 py-4 !bg-white !text-[var(--color-forest-green)] hover:!bg-gray-100 !border-transparent">
                                    {{ $heroSection->cta_label }} </x-button-primary> </div>
                        @endif
            </div>
        </div>
    </section>

     

    <x-home-welcome-section
        class="about-green-section"
        :intro-section="$introSection"
        :pillar-sections="$pillarSections"
        :welcome-grid-sections="$welcomeGridSections"
    />

    <!-- <section id="welcome-section" class="section-padding bg-white about-green-section">
       
        <div class="about-green-ghost" aria-hidden="true">Crafting Bespoke Luxury<br> Experiences Across Africa</div>
    </section> -->

    <!-- Our Experiences — deep savanna band (contrast vs welcome cream) -->
    <section class="experiences-section experiences-section--elevated section-padding" aria-labelledby="experiences-heading">
        <div class="experiences-section__video-wrap" aria-hidden="true">
            <iframe
                class="experiences-section__video-iframe"
                src="https://www.youtube-nocookie.com/embed/AA0UZVXJd2o?autoplay=1&amp;mute=1&amp;loop=1&amp;playlist=AA0UZVXJd2o&amp;controls=0&amp;rel=0&amp;modestbranding=1&amp;playsinline=1&amp;iv_load_policy=3"
                title="Background video for Experiences section"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                loading="lazy"
                tabindex="-1"
            ></iframe>
        </div>
        <div class="experiences-section__video-overlay" aria-hidden="true"></div>
        <div class="experiences-section__ambient" aria-hidden="true"></div>
        <div class="experiences-section-inner max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-[3]">
            <header class="experiences-section-header text-center js-scroll">
                <p class="experiences-section-eyebrow">Our journeys</p>
                <div class="experiences-section-title-stack">
                    <h2 id="experiences-heading" class="experiences-section-title font-serif">
                        Experiences
                    </h2>
                    <div class="experiences-section-title-rule" aria-hidden="true"></div>
                </div>
            </header>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8 lg:gap-10 experience-grid items-stretch js-scroll-stagger">
                <div class="experience-card experience-card--luxury experience-card--text-only overflow-hidden rounded-2xl">
                    <div class="experience-content">
                        <h3 class="experience-title text-base sm:text-xl lg:text-2xl font-serif font-semibold">Bespoke Safaris</h3>
                        <div>
                            <x-button-secondary href="{{ route('journeys.signature-safaris') }}" class="experience-card-btn border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent text-sm px-4 py-2">
                                View Safaris
                            </x-button-secondary>
                        </div>
                    </div>
                </div>

                <div class="experience-card experience-card--luxury experience-card--text-only overflow-hidden rounded-2xl">
                    <div class="experience-content">
                        <h3 class="experience-title text-base sm:text-xl lg:text-2xl font-serif font-semibold">Luxury Escapes</h3>
                        <div>
                            <x-button-secondary href="{{ route('journeys.luxury-retreats') }}" class="experience-card-btn border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent text-sm px-4 py-2">
                                View Escapes
                            </x-button-secondary>
                        </div>
                    </div>
                </div>

                <div class="experience-card experience-card--luxury experience-card--text-only overflow-hidden rounded-2xl">
                    <div class="experience-content">
                        <h3 class="experience-title text-base sm:text-xl lg:text-2xl font-serif font-semibold">Conservation &amp; Community</h3>
                        <div>
                            <x-button-secondary href="{{ route('journeys.conservation-community') }}" class="experience-card-btn border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent text-sm px-4 py-2">
                                View Impact Journeys
                            </x-button-secondary>
                        </div>
                    </div>
                </div>

                <div class="experience-card experience-card--luxury experience-card--text-only overflow-hidden rounded-2xl">
                    <div class="experience-content">
                        <h3 class="experience-title text-base sm:text-xl lg:text-2xl font-serif font-semibold">Bespoke Private Travel</h3>
                        <div>
                            <x-button-secondary href="{{ route('journeys.bespoke-private') }}" class="experience-card-btn border-white text-white hover:bg-white hover:text-[var(--color-forest-green)] focus:ring-white focus:ring-offset-transparent text-sm px-4 py-2">
                                View Private Travel
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
                ['section' => $pillarCulture, 'title' => 'Culture', 'fallback' => 'Heritage and knowledge—respected, not performed.', 'cta_link' => route('impact.responsible-travel'), 'svg' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['section' => $pillarCommunity, 'title' => 'Community', 'fallback' => 'Women-led groups, local hosts, fair income.', 'cta_link' => route('impact.climate-community'), 'svg' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                ['section' => $pillarConservation, 'title' => 'Conservation', 'fallback' => 'Wildlife, habitat, restoration on the ground.', 'cta_link' => route('impact.responsible-travel'), 'svg' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['section' => $pillarChangeAgents, 'title' => 'Change agents', 'fallback' => 'People who push the work forward locally.', 'cta_link' => route('trust.index'), 'svg' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                ['section' => $pillarClimateAction, 'title' => 'Climate', 'fallback' => 'Footprint down; nature-based action up.', 'cta_link' => route('impact.climate-community'), 'svg' => 'M12 3v18m9-9H3'],
            ];
            @endphp
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    Five pillars
                </h2>
                <p class="text-sm text-[var(--color-earth-brown)] max-w-xl mx-auto">
                    Women &amp; community sit at the centre—alongside culture, conservation, climate.
                </p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-8 js-scroll-stagger">
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
            <div class="text-center mb-10 js-scroll">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    Explore Africa
                </h2>
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 explore-africa-grid js-scroll-stagger">
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
            window.setTimeout(hideHeroVideoPreloader, 6500);
        }

        function initHeroCarousel() {
            const root = document.getElementById('hero-carousel');
            if (!root) return;

            const slides = Array.from(root.querySelectorAll('[data-hero-slide]'));
            const dots = Array.from(root.querySelectorAll('[data-hero-dot]'));
            const fill = root.querySelector('[data-hero-progress-fill]');
            const btnPrev = root.querySelector('[data-hero-prev]');
            const btnNext = root.querySelector('[data-hero-next]');
            if (!slides.length) return;

            let idx = 0;
            const raw = parseInt(root.getAttribute('data-interval-ms') || '6000', 10);
            const intervalMs = Math.max(3000, Math.min(30000, Number.isFinite(raw) ? raw : 6000));
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            let fallbackTimer = null;
            let pausedHover = false;
            let controlPointerDown = false;
            let chromeHasFocus = false;

            function updatePauseState() {
                root.classList.toggle('is-paused', pausedHover || controlPointerDown || chromeHasFocus);
            }

            function go(i) {
                idx = (i + slides.length) % slides.length;
                slides.forEach((s, j) => {
                    const on = j === idx;
                    s.classList.toggle('is-active', on);
                    s.setAttribute('aria-hidden', on ? 'false' : 'true');
                });
                dots.forEach((d, j) => {
                    d.classList.toggle('is-active', j === idx);
                    d.setAttribute('aria-selected', j === idx ? 'true' : 'false');
                });
                restartProgress();
            }

            function next() {
                go(idx + 1);
            }

            function prev() {
                go(idx - 1);
            }

            function clearFallbackTimer() {
                if (fallbackTimer) {
                    clearInterval(fallbackTimer);
                    fallbackTimer = null;
                }
            }

            function restartProgress() {
                clearFallbackTimer();
                if (!fill || slides.length < 2) return;

                fill.classList.remove('is-animating');
                void fill.offsetWidth;

                if (reduceMotion) {
                    fallbackTimer = window.setInterval(() => {
                        if (!root.classList.contains('is-paused')) next();
                    }, intervalMs);
                    return;
                }

                fill.style.animationDuration = intervalMs + 'ms';
                fill.classList.add('is-animating');
            }

            if (fill && slides.length > 1 && !reduceMotion) {
                fill.addEventListener('animationend', (e) => {
                    if (e.target !== fill) return;
                    const name = e.animationName || '';
                    if (!name.includes('heroCarouselProgressFill')) return;
                    next();
                });
            }

            dots.forEach((d) => {
                const j = parseInt(d.getAttribute('data-hero-dot') || '0', 10);
                d.addEventListener('click', () => go(j));
            });

            if (btnPrev) btnPrev.addEventListener('click', () => prev());
            if (btnNext) btnNext.addEventListener('click', () => next());

            document.addEventListener('keydown', (e) => {
                const chromeEl = root.querySelector('[data-hero-carousel-chrome]');
                if (!chromeEl || !chromeEl.contains(document.activeElement)) return;
                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    prev();
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    next();
                }
            });

            const controlSelectors = '[data-hero-dot],[data-hero-prev],[data-hero-next]';
            root.querySelectorAll(controlSelectors).forEach((el) => {
                el.addEventListener('pointerdown', () => {
                    controlPointerDown = true;
                    updatePauseState();
                });
            });
            document.addEventListener('pointerup', () => {
                controlPointerDown = false;
                updatePauseState();
            });
            document.addEventListener('pointercancel', () => {
                controlPointerDown = false;
                updatePauseState();
            });

            const chrome = root.querySelector('[data-hero-carousel-chrome]');
            if (chrome) {
                chrome.addEventListener('focusin', () => {
                    chromeHasFocus = true;
                    updatePauseState();
                });
                chrome.addEventListener('focusout', (e) => {
                    if (!chrome.contains(e.relatedTarget)) {
                        chromeHasFocus = false;
                        updatePauseState();
                    }
                });
            }

            const heroSectionEl = document.getElementById('hero-section');
            if (heroSectionEl) {
                heroSectionEl.addEventListener('mouseenter', () => {
                    pausedHover = true;
                    updatePauseState();
                });
                heroSectionEl.addEventListener('mouseleave', () => {
                    pausedHover = false;
                    updatePauseState();
                });
            }

            if (slides.length > 1) {
                restartProgress();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            initHeroCarousel();
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
    <section class="luxury-teaser-section bg-white responsible-teaser-shell">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 lg:gap-0 luxury-equal-grid js-scroll responsible-teaser-grid">
                <div class="luxury-copy-col responsible-teaser-copy">
                    <p class="responsible-kicker">Impact in action</p>
                    <h2 class="luxury-heading mobile-underline-fit font-serif font-bold text-[var(--color-forest-green)] mb-0 text-center md:text-left">
                        {{ $responsibleTravelSection?->title ?: 'Responsible Travel & Carbon Offsetting' }}
                    </h2>
                    <br>
               
                    <div class="responsible-copy-body">
                        {!! $responsibleTravelSection?->content ?: 'Lower impact travel, offsets where they matter, and nature-based projects—aligned with our mission on <strong>environmental sustainability</strong>.' !!}
                    </div>
                    <div class="responsible-pill-row" aria-hidden="true">
                        <span class="responsible-pill">Carbon-aware planning</span>
                        <span class="responsible-pill">Nature-based restoration</span>
                        <span class="responsible-pill">Community-first impact</span>
                    </div>
                    @if(filled($responsibleTravelSection?->cta_label) && filled($responsibleTravelSection?->cta_link))
                        <x-button-secondary href="{{ $responsibleTravelSection->cta_link }}" class="inline-flex w-auto self-start text-sm px-6 py-3 tracking-wide responsible-teaser-cta">
                            {{ $responsibleTravelSection->cta_label }}
                        </x-button-secondary>
                    @else
                        <x-button-secondary href="{{ route('impact.responsible-travel') }}" class="inline-flex w-auto self-start text-sm px-6 py-3 tracking-wide responsible-teaser-cta">
                            Learn More
                        </x-button-secondary>
                    @endif
                </div>
                <div class="luxury-media-col">
                    <div class="luxury-media-frame bg-[var(--color-sand-beige)] responsible-media-frame">
                    @if(filled($responsibleTravelSection?->image))
                        <img
                            src="{{ asset('storage/' . $responsibleTravelSection->image) }}"
                            alt="{{ $responsibleTravelSection?->title ?: 'Responsible travel teaser image' }}"
                            class="w-full h-full object-cover"
                        >
                    @endif
                    </div>
                    <div class="responsible-media-badge">
                        <span class="responsible-media-badge-label">Responsible by design</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <!-- Women & Restoration Teaser -->
    <section class="luxury-teaser-section bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 luxury-equal-grid js-scroll">
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
                    
                    {!! $womenRestorationSection?->content ?: '<strong>Women-led restoration.</strong> Mangroves, seedballs, cooperatives—core to how we <strong>empower women</strong> and protect land. Same focus as our mission statement.' !!}
                    
                    
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

    <x-home-blog-section :posts="$blogPosts" />

    <!-- Back to hero arrow (fixed bottom right); shown when user has scrolled down -->
    <a href="#hero-section" id="back-to-hero-btn" class="back-to-hero-arrow fixed bottom-20 md:bottom-8 right-4 md:right-8 z-30 w-12 h-12 md:w-14 md:h-14 rounded-full bg-[var(--color-nav-active)] text-white shadow-lg hover:bg-[var(--color-forest-green)] focus:outline-none focus:ring-2 focus:ring-[var(--color-nav-active)] focus:ring-offset-2 flex items-center justify-center transition-all duration-300 opacity-0 pointer-events-none" aria-label="Back to hero section">
        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </a>
@endsection
