@props([
    'useCarousel' => false,
    'slides' => null,
    'vimeoVideoId' => '1058906686',
    'carouselIntervalMs' => 6000,
    'heroCalloutSection' => null,
])

@php
    $slideList = $slides instanceof \Illuminate\Support\Collection ? $slides : collect($slides ?? []);
    $carouselIntervalMs = max(3000, min(30000, (int) $carouselIntervalMs));
@endphp

<div class="hero-video-container z-0 {{ $useCarousel ? 'hero-carousel-host' : '' }}">
    @if($useCarousel && $slideList->isNotEmpty())
        <div
            id="hero-carousel"
            class="hero-carousel"
            role="region"
            aria-roledescription="carousel"
            aria-label="Homepage hero images"
            data-interval-ms="{{ $carouselIntervalMs }}"
            data-slide-count="{{ $slideList->count() }}"
        >
            @foreach($slideList as $index => $slide)
                @php
                    $isFirst = $index === 0;
                    $alt = filled($slide->image_alt) ? $slide->image_alt : 'Hero background';
                @endphp
                <div
                    class="hero-carousel-slide {{ $isFirst ? 'is-active' : '' }}"
                    role="group"
                    aria-roledescription="slide"
                    aria-label="Slide {{ $index + 1 }} of {{ $slideList->count() }}"
                    @if(!$isFirst) aria-hidden="true" @endif
                    data-hero-slide
                >
                    <img
                        src="{{ $slide->imageUrl() }}"
                        alt="{{ $alt }}"
                        class="hero-carousel-img"
                        width="1920"
                        height="1080"
                        sizes="100vw"
                        decoding="async"
                        @if($isFirst) fetchpriority="high" @else loading="lazy" @endif
                    >
                    @if(filled($slide->overlay_title) || filled($slide->overlay_subtitle))
                        <div class="hero-carousel-slide-caption" aria-hidden="true">
                            @if(filled($slide->overlay_title))
                                <p class="hero-carousel-slide-caption-title">{{ $slide->overlay_title }}</p>
                            @endif
                            @if(filled($slide->overlay_subtitle))
                                <p class="hero-carousel-slide-caption-sub">{{ $slide->overlay_subtitle }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach

            @if($slideList->count() > 1)
                <div class="hero-carousel-chrome" data-hero-carousel-chrome>
                    <div class="hero-carousel-toolbar" role="group" aria-label="Hero carousel controls">
                        <button
                            type="button"
                            class="hero-carousel-nav-btn hero-carousel-prev"
                            data-hero-prev
                            aria-label="Previous slide"
                        >
                            <svg class="hero-carousel-nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <div class="hero-carousel-dots hero-carousel-dots--toolbar" role="tablist" aria-label="Slides">
                            @foreach($slideList as $index => $slide)
                                <button
                                    type="button"
                                    role="tab"
                                    class="hero-carousel-dot {{ $index === 0 ? 'is-active' : '' }}"
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-label="Go to slide {{ $index + 1 }} of {{ $slideList->count() }}"
                                    data-hero-dot="{{ $index }}"
                                ></button>
                            @endforeach
                        </div>
                        <button
                            type="button"
                            class="hero-carousel-nav-btn hero-carousel-next"
                            data-hero-next
                            aria-label="Next slide"
                        >
                            <svg class="hero-carousel-nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                    <div
                        class="hero-carousel-progress"
                        data-hero-progress-root
                        aria-hidden="true"
                    >
                        <div class="hero-carousel-progress-track">
                            <div class="hero-carousel-progress-fill" data-hero-progress-fill></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="video-wrapper">
            <iframe
                id="hero-vimeo-iframe"
                src="https://player.vimeo.com/video/{{ $vimeoVideoId }}?background=1&amp;autoplay=1&amp;loop=1&amp;muted=1&amp;controls=0&amp;playsinline=0"
                title="Homepage background video"
                frameborder="0"
                allow="autoplay; fullscreen"
                allowfullscreen
            ></iframe>
        </div>
    @endif

    <div class="absolute inset-0 bg-[var(--color-forest-green)] opacity-40 z-10 pointer-events-none"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/60 z-10 pointer-events-none"></div>

    <div class="hero-eco-callout">
        <p class="callout-subtitle">{!! nl2br(e($heroCalloutSection?->subtitle ?: "Immerse yourself in our wild,\nprecious world")) !!}</p>
        <p class="callout-title">{{ $heroCalloutSection?->title ?: 'Where Eco is Luxury' }}</p>
        <a href="#welcome-section" class="callout-arrow-link" aria-label="Scroll to welcome section">
            <span class="callout-arrow-line" aria-hidden="true"></span>
            <span class="callout-arrow-line second" aria-hidden="true"></span>
        </a>
    </div>
</div>
