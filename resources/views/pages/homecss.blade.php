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
    /* Vimeo cover sizing: always fill hero without left/right or top/bottom bars */
    width: 177.78vh !important; /* 16:9 */
    height: 56.25vw !important; /* 16:9 */
    min-width: 100vw !important;
    min-height: 100vh !important;
    max-width: none !important;
    margin: 0 !important;
    transform: translate(-50%, -50%) !important;
    pointer-events: none;
    border: 0;
}

@media (max-width: 767px) {
    /* Mobile hero: no fixed height; section follows video aspect ratio */
    section.hero-section-wrapper.hero-section-full-viewport {
        height: auto !important;
        min-height: 0 !important;
        max-height: none !important;
        aspect-ratio: 16 / 9 !important;
    }

    section.hero-section-wrapper .hero-video-container,
    section.hero-section-wrapper .video-wrapper {
        width: 100% !important;
        height: 100% !important;
        min-height: 100% !important;
        max-height: none !important;
    }

    section.hero-section-wrapper .video-wrapper iframe {
        /* True stretch-to-fit on mobile: fill hero bounds exactly */
        top: 0 !important;
        left: 0 !important;
        transform: none !important;
        width: 100% !important;
        height: 100% !important;
        min-width: 100% !important;
        min-height: 100% !important;
    }

    section.hero-section-wrapper .hero-carousel,
    section.hero-section-wrapper .hero-carousel-slide {
        width: 100% !important;
        height: 100% !important;
        min-height: 100% !important;
    }
}

/* Homepage hero: image carousel (alternative to Vimeo) */
.hero-carousel-host .hero-carousel {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
    pointer-events: none;
}

.hero-carousel-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 1.1s ease-in-out;
    z-index: 0;
    pointer-events: none;
}

.hero-carousel-slide.is-active {
    opacity: 1;
    z-index: 1;
}

.hero-carousel-img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.hero-carousel-slide-caption {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 1rem 1.25rem 4.5rem;
    z-index: 2;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.55), transparent);
    pointer-events: none;
    text-align: center;
}

@media (min-width: 768px) {
    .hero-carousel-slide-caption {
        text-align: left;
        max-width: 28rem;
        padding-bottom: 5rem;
        background: none;
    }
}

.hero-carousel-slide-caption-title {
    font-family: "Playfair Display", ui-serif, Georgia, serif;
    font-size: 1.125rem;
    font-weight: 700;
    color: rgba(255, 255, 255, 0.98);
    margin: 0;
    line-height: 1.25;
}

.hero-carousel-slide-caption-sub {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.88);
    margin: 0.35rem 0 0;
    line-height: 1.35;
}

/* Carousel chrome: toolbar same vertical band as scroll arrow (right); progress at true bottom */
.hero-carousel-chrome {
    position: absolute;
    inset: 0;
    z-index: 26;
    pointer-events: none;
    padding: 0;
}

.hero-carousel-toolbar {
    pointer-events: auto;
    position: absolute;
    right: max(0.75rem, env(safe-area-inset-right, 0px));
    left: auto;
    /* Line up with eco callout / down-arrow stack (bottom edge of that block) */
    bottom: var(--hero-callout-bottom, 2rem);
    transform: none;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.65rem;
    flex-wrap: nowrap;
    max-width: min(100% - 1.5rem, 22rem);
}

.hero-carousel-nav-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 9999px;
    border: 1px solid rgba(255, 255, 255, 0.45);
    background: rgba(0, 0, 0, 0.25);
    color: rgba(255, 255, 255, 0.95);
    cursor: pointer;
    transition: background-color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
}

.hero-carousel-nav-btn:hover {
    background: rgba(255, 255, 255, 0.12);
    border-color: rgba(255, 255, 255, 0.75);
}

.hero-carousel-nav-btn:focus-visible {
    outline: none;
    box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.85), 0 0 0 4px rgba(26, 77, 58, 0.5);
}

.hero-carousel-nav-icon {
    flex-shrink: 0;
}

.hero-carousel-dots--toolbar {
    position: static;
    left: auto;
    bottom: auto;
    transform: none;
    z-index: auto;
    display: flex;
    gap: 0.5rem;
    pointer-events: auto;
    flex-wrap: wrap;
    justify-content: center;
    max-width: min(100%, 20rem);
}

.hero-carousel-progress {
    pointer-events: none;
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    max-width: none;
    margin: 0;
    padding: 0 max(0.75rem, env(safe-area-inset-left, 0px)) max(0.35rem, env(safe-area-inset-bottom, 0px)) max(0.75rem, env(safe-area-inset-right, 0px));
}

.hero-carousel-progress-track {
    height: 3px;
    border-radius: 9999px;
    background: rgba(255, 255, 255, 0.22);
    overflow: hidden;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.2);
}

.hero-carousel-progress-fill {
    display: block;
    height: 100%;
    width: 100%;
    transform-origin: left center;
    transform: scaleX(0);
    border-radius: inherit;
    background: linear-gradient(
        90deg,
        var(--color-accent-gold, #c9a227) 0%,
        rgba(255, 255, 255, 0.92) 55%,
        var(--color-accent-gold, #c9a227) 100%
    );
    box-shadow: 0 0 14px rgba(201, 162, 39, 0.55), 0 0 6px rgba(255, 255, 255, 0.35);
}

@keyframes heroCarouselProgressFill {
    from {
        transform: scaleX(0);
    }
    to {
        transform: scaleX(1);
    }
}

.hero-carousel-progress-fill.is-animating {
    animation-name: heroCarouselProgressFill;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
    will-change: transform;
}

.hero-carousel.is-paused .hero-carousel-progress-fill.is-animating {
    animation-play-state: paused;
}

@media (prefers-reduced-motion: reduce) {
    .hero-carousel-progress-fill.is-animating {
        animation: none !important;
        transform: scaleX(0) !important;
    }
}

.hero-carousel-dot {
    width: 0.55rem;
    height: 0.55rem;
    padding: 0;
    border-radius: 9999px;
    border: 1px solid rgba(255, 255, 255, 0.65);
    background: rgba(255, 255, 255, 0.2);
    cursor: pointer;
    transition: background-color 0.25s ease, transform 0.25s ease;
}

.hero-carousel-dot:hover,
.hero-carousel-dot:focus-visible {
    background: rgba(255, 255, 255, 0.55);
    outline: none;
    box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.4);
}

.hero-carousel-dot.is-active {
    background: rgba(255, 255, 255, 0.95);
    transform: scale(1.15);
}

@media (prefers-reduced-motion: reduce) {
    .hero-carousel-slide {
        transition-duration: 0.01ms;
    }
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

/* Shared bottom offset: carousel controls align with scroll-arrow band */
.hero-video-container {
    --hero-callout-bottom: 2rem;
}

.hero-eco-callout {
    position: absolute;
    left: 50%;
    bottom: var(--hero-callout-bottom);
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

/* Welcome: two-column intro + 2×2 pillar grid (refined luxury palette) */
.welcome-section {
    position: relative;
    overflow: hidden;
}

.welcome-section--refined {
    --welcome-cream: #f9f8f3;
    --welcome-olive: #3a3d30;
    --welcome-muted-gold: #8c864f;
    --welcome-body: #4a4844;
    background-color: var(--welcome-cream);
}

.welcome-section--refined .about-green-intro {
    color: var(--welcome-muted-gold);
    font-size: 0.8125rem;
    letter-spacing: 0.22em;
    font-weight: 600;
}

.welcome-section--refined .welcome-split-title,
.welcome-section--refined .about-green-title.welcome-split-title {
    color: var(--welcome-olive);
    font-weight: 600;
}

.welcome-section--refined .welcome-split-body,
.welcome-section--refined .welcome-split-copy-inner.about-green-copy {
    color: var(--welcome-body);
    line-height: 1.82;
}

.welcome-section--refined .welcome-split-body strong {
    color: var(--welcome-olive);
    font-weight: 700;
}

/* Slightly tighter title in narrow copy column (still prominent) */
.welcome-split-title {
    font-size: clamp(1.65rem, 4.2vw, 2.75rem);
    margin-bottom: clamp(0.85rem, 2vw, 1.15rem);
}

.welcome-split {
    display: grid;
    gap: clamp(2rem, 4vw, 3.25rem);
    align-items: center;
}

@media (min-width: 1024px) {
    .welcome-split {
        grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
        gap: clamp(2.5rem, 5vw, 3.75rem);
    }
}

.welcome-split-copy-inner {
    margin-left: auto;
    margin-right: auto;
}

@media (max-width: 1023px) {
    .welcome-split-copy-inner {
        text-align: center;
        max-width: 40rem;
    }
}

@media (min-width: 1024px) {
    .welcome-split-copy-inner {
        text-align: left;
        margin-left: 0;
        margin-right: 0;
        max-width: 34rem;
    }
}

/* CTA under welcome paragraph — ghost button, reference layout (left-aligned) */
.welcome-split-cta {
    margin-top: clamp(1.35rem, 3.2vw, 1.85rem);
    text-align: left;
}

@media (max-width: 1023px) {
    .welcome-split-cta {
        text-align: center;
    }
}

/* Outline CTA: thin border, slight radius, typographic arrow — matches mockup */
.welcome-section--refined .welcome-impact-btn {
    display: inline-block;
    padding: 0.625rem 1.35rem;
    font-family: var(--font-sans, 'Instrument Sans', ui-sans-serif, system-ui, sans-serif);
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    color: var(--welcome-olive, #3a3d30);
    background: transparent;
    border: 1px solid var(--welcome-olive, #3a3d30);
    border-radius: 6px;
    text-decoration: none;
    transition: background-color 0.22s ease, color 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease;
    box-shadow: none;
}

.welcome-section--refined .welcome-impact-btn:hover {
    background: rgba(58, 61, 48, 0.06);
    color: var(--welcome-olive, #3a3d30);
    border-color: #2e3128;
}

.welcome-section--refined .welcome-impact-btn:focus-visible {
    outline: 2px solid var(--welcome-muted-gold, #8c864f);
    outline-offset: 3px;
}

.welcome-section--refined .welcome-impact-btn-arrow {
    display: inline-block;
    margin-left: 0.35rem;
    font-weight: 400;
    transition: transform 0.22s ease;
}

.welcome-section--refined .welcome-impact-btn:hover .welcome-impact-btn-arrow {
    transform: translateX(4px);
}

/* Fallback if section class changes */
.welcome-impact-btn {
    display: inline-block;
    padding: 0.625rem 1.35rem;
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    color: #3a3d30;
    background: transparent;
    border: 1px solid #3a3d30;
    border-radius: 6px;
    text-decoration: none;
    transition: background-color 0.22s ease, border-color 0.22s ease;
}

.welcome-impact-btn:hover {
    background: rgba(58, 61, 48, 0.06);
    border-color: #2e3128;
}

.welcome-impact-btn:focus-visible {
    outline: 2px solid #8c864f;
    outline-offset: 3px;
}

.welcome-impact-btn-arrow {
    display: inline-block;
    margin-left: 0.35rem;
    transition: transform 0.22s ease;
}

.welcome-impact-btn:hover .welcome-impact-btn-arrow {
    transform: translateX(4px);
}

.welcome-pillars-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0.65rem;
    width: 100%;
    max-width: 28rem;
    margin-left: auto;
    margin-right: auto;
}

@media (min-width: 640px) {
    .welcome-pillars-grid {
        gap: 0.85rem;
        max-width: none;
    }
}

@media (min-width: 1024px) {
    .welcome-pillars-grid {
        margin-left: 0;
        margin-right: 0;
        gap: 1rem;
    }
}

.welcome-pillar-tile {
    display: block;
    text-decoration: none;
    color: inherit;
    border-radius: 1.125rem;
    overflow: hidden;
    border: 1px solid rgba(58, 61, 48, 0.14);
    box-shadow: 0 6px 24px rgba(58, 61, 48, 0.08);
    transition: box-shadow 0.35s ease, transform 0.35s ease, border-color 0.35s ease;
}

.welcome-section--refined .welcome-pillar-tile {
    border-radius: 1.25rem;
    border-color: rgba(58, 61, 48, 0.12);
    box-shadow: 0 8px 28px rgba(0, 0, 0, 0.07);
}

.welcome-pillar-tile:hover {
    box-shadow: 0 16px 44px rgba(58, 61, 48, 0.14);
    transform: translateY(-3px);
    border-color: rgba(58, 61, 48, 0.22);
}

.welcome-pillar-tile-media {
    position: relative;
    display: block;
    aspect-ratio: 1 / 1;
    overflow: hidden;
    background: #ebe8e0;
}

.welcome-pillar-tile-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.55s cubic-bezier(0.25, 0.1, 0.25, 1);
}

.welcome-pillar-tile:hover .welcome-pillar-tile-img,
.welcome-pillar-tile:focus-visible .welcome-pillar-tile-img {
    transform: scale(1.07);
}

.welcome-pillar-tile-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.18) 48%, transparent 100%);
    opacity: 0.88;
    transition: opacity 0.35s ease, background 0.35s ease;
    pointer-events: none;
}

.welcome-pillar-tile:hover .welcome-pillar-tile-overlay,
.welcome-pillar-tile:focus-visible .welcome-pillar-tile-overlay {
    opacity: 1;
    background: linear-gradient(to top, rgba(58, 61, 48, 0.88) 0%, rgba(0, 0, 0, 0.3) 55%, transparent 100%);
}

.welcome-pillar-tile-label {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 0.75rem 0.85rem;
    z-index: 2;
    pointer-events: none;
}

.welcome-pillar-tile-title {
    display: block;
    font-family: var(--font-sans, 'Instrument Sans', ui-sans-serif, system-ui, sans-serif);
    font-size: clamp(0.72rem, 2vw, 0.8125rem);
    font-weight: 700;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 0.14em;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.55);
}

@media (prefers-reduced-motion: reduce) {
    .welcome-pillar-tile,
    .welcome-pillar-tile-img,
    .welcome-pillar-tile-overlay {
        transition-duration: 0.01ms;
    }

    .welcome-pillar-tile:hover,
    .welcome-pillar-tile:focus-visible {
        transform: none;
    }

    .welcome-pillar-tile:hover .welcome-pillar-tile-img,
    .welcome-pillar-tile:focus-visible .welcome-pillar-tile-img {
        transform: none;
    }
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

/* ========== Experiences: deep band vs welcome cream (#f9f8f3) ========== */
.experiences-section {
    position: relative;
    isolation: isolate;
    overflow: hidden;
}

.experiences-section--elevated {
    padding-top: clamp(4.75rem, 9vw, 7rem);
    padding-bottom: clamp(5.25rem, 10vw, 8rem);
    background: transparent;
    border-top: 3px solid rgba(212, 175, 55, 0.45);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.06);
}

.experiences-section__video-wrap {
    pointer-events: none;
    position: absolute;
    inset: 0;
    z-index: 0;
    overflow: hidden;
    /* Size units for iframe “cover” math (section is often taller than the viewport on mobile). */
    container-type: size;
    container-name: experiences-video;
}

/* 16:9 embed scaled to cover the *section* box (not the viewport), so tall stacks don’t letterbox. */
.experiences-section .experiences-section__video-wrap .experiences-section__video-iframe {
    position: absolute !important;
    top: 50% !important;
    left: 50% !important;
    right: auto !important;
    bottom: auto !important;
    width: max(100cqw, calc(100cqh * 16 / 9)) !important;
    height: max(100cqh, calc(100cqw * 9 / 16)) !important;
    max-width: none !important;
    margin: 0 !important;
    transform: translate(-50%, -50%) !important;
    border: 0;
}

/* Fallback when container query units aren’t available: favor filling height (fixes tall mobile sections). */
@supports not (width: 1cqw) {
    .experiences-section .experiences-section__video-wrap .experiences-section__video-iframe {
        width: max(100%, 177.78vh) !important;
        height: max(100%, 56.25vw) !important;
        min-width: 100% !important;
        min-height: 100% !important;
    }
}

.experiences-section__video-overlay {
    pointer-events: none;
    position: absolute;
    inset: 0;
    z-index: 1;
    background:
        radial-gradient(ellipse 100% 60% at 50% 0%, rgba(212, 175, 55, 0.14) 0%, transparent 55%),
        radial-gradient(ellipse 55% 40% at 100% 40%, rgba(97, 172, 69, 0.12) 0%, transparent 50%),
        radial-gradient(ellipse 50% 35% at 0% 75%, rgba(26, 77, 58, 0.35) 0%, transparent 50%),
        linear-gradient(165deg, rgba(20, 34, 28, 0.88) 0%, rgba(26, 47, 38, 0.88) 38%, rgba(30, 58, 46, 0.88) 72%, rgba(21, 40, 32, 0.88) 100%);
}

.experiences-section__ambient {
    pointer-events: none;
    position: absolute;
    inset: 0;
    z-index: 2;
    opacity: 0.5;
    background-image:
        radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.04) 0%, transparent 40%),
        radial-gradient(circle at 85% 20%, rgba(212, 175, 55, 0.07) 0%, transparent 35%);
}

@media (prefers-reduced-motion: reduce) {
    .experiences-section__video-wrap {
        display: none;
    }

    .experiences-section__video-overlay {
        background:
            radial-gradient(ellipse 100% 60% at 50% 0%, rgba(212, 175, 55, 0.14) 0%, transparent 55%),
            radial-gradient(ellipse 55% 40% at 100% 40%, rgba(97, 172, 69, 0.12) 0%, transparent 50%),
            radial-gradient(ellipse 50% 35% at 0% 75%, rgba(26, 77, 58, 0.35) 0%, transparent 50%),
            linear-gradient(165deg, #14221c 0%, #1a2f26 38%, #1e3a2e 72%, #152820 100%);
    }
}

.experiences-section--elevated .experiences-section-header {
    margin-bottom: clamp(2.5rem, 5vw, 3.75rem);
}

.experiences-section--elevated .experiences-section-eyebrow {
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.24em;
    text-transform: uppercase;
    color: #d4af37;
    margin-bottom: 0.65rem;
}

.experiences-section--elevated .experiences-section-title {
    color: #faf9f6;
    font-size: clamp(2.35rem, 5.5vw, 3.35rem);
    font-weight: 600;
    line-height: 1.08;
    letter-spacing: 0.02em;
    text-shadow: 0 2px 24px rgba(0, 0, 0, 0.25);
}

.experiences-section-title-stack {
    display: inline-flex;
    flex-direction: column;
    align-items: stretch;
    max-width: 100%;
    margin-inline: auto;
}

.experiences-section-title-stack .experiences-section-title {
    width: fit-content;
    max-width: 100%;
}

.experiences-section-title-rule {
    width: 100%;
    height: 3px;
    margin: 1.15rem 0 0;
    border-radius: 999px;
    background: linear-gradient(90deg, transparent, #d4af37 20%, #e8c547 50%, #d4af37 80%, transparent);
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.35);
}

.experiences-section .experience-grid {
    position: relative;
    z-index: 1;
}

.experiences-section .experience-grid .experience-card {
    position: relative;
    height: 100%;
    min-height: clamp(22rem, 52vw, 28rem);
    border-radius: 1.35rem;
    border: 1px solid rgba(255, 255, 255, 0.14);
    box-shadow:
        0 4px 0 rgba(212, 175, 55, 0.12),
        0 24px 56px rgba(0, 0, 0, 0.38),
        inset 0 1px 0 rgba(255, 255, 255, 0.08);
    transition: transform 0.35s cubic-bezier(0.25, 0.1, 0.25, 1), box-shadow 0.35s ease, border-color 0.35s ease;
}

.experiences-section .experience-grid .experience-card--text-only {
    min-height: clamp(13rem, 36vw, 17rem);
    display: flex;
    flex-direction: column;
    background: rgba(8, 16, 13, 0.45);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.experiences-section .experience-grid .experience-card--text-only .experience-content {
    position: relative;
    inset: auto;
    z-index: 1;
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: clamp(1.75rem, 4vw, 2.5rem) 1.5rem;
    gap: 1.25rem;
}

.experiences-section .experience-grid .experience-card--text-only .experience-title {
    margin-bottom: 0;
}

.experiences-section .experience-grid .experience-card .experience-title {
    color: #fff;
    margin-bottom: 1rem;
    font-weight: 600;
    letter-spacing: 0.02em;
    text-shadow: 0 2px 12px rgba(0, 0, 0, 0.45);
}

.experiences-section .experience-grid .experience-card .experience-card-btn {
    padding: 0.55rem 1.15rem;
    font-size: 0.8125rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    border-width: 1px;
    border-color: rgba(249, 248, 243, 0.85);
    background: rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(4px);
    border-radius: 0.375rem;
    transition: background 0.25s ease, color 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
}

.experiences-section .experience-grid .experience-card .experience-content a:hover {
    background: #faf9f6 !important;
    color: #1a4d3a !important;
    border-color: #faf9f6 !important;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
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
    transform: translateY(-8px);
    border-color: rgba(212, 175, 55, 0.45);
    box-shadow:
        0 6px 0 rgba(212, 175, 55, 0.2),
        0 32px 64px rgba(0, 0, 0, 0.45),
        0 0 0 1px rgba(255, 255, 255, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.12);
}

.experiences-section .experience-grid .experience-card:hover .experience-image {
    transform: scale(1.06);
}

.experiences-section h2,
.experiences-section .experiences-section-title {
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
    .hero-video-container {
        --hero-callout-bottom: 1.35rem;
    }

    /* Scale down hero callout text on mobile: "Immerse yourself... / Where Eco is Luxury" */
    .hero-eco-callout {
        width: min(88vw, 22rem);
    }

    .hero-eco-callout .callout-subtitle {
        font-size: 0.86rem;
        line-height: 1.25;
    }
    .hero-eco-callout .callout-title {
        font-size: 1.05rem;
        line-height: 1.18;
        margin-top: 0.15rem;
    }

    .hero-eco-callout .callout-arrow-link {
        margin-top: 0.5rem;
        padding: 0.2rem 0.35rem;
        gap: 0.16rem;
    }

    .hero-eco-callout .callout-arrow-line {
        width: 0.72rem;
        height: 0.72rem;
        border-right-width: 1.6px;
        border-bottom-width: 1.6px;
    }

    .hero-eco-callout .callout-arrow-line.second {
        margin-top: -0.32rem;
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
        width: fit-content !important;
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    /* Strong override for specific teaser titles: keep underline width to text only */
    .luxury-teaser-section .mobile-underline-fit {
        display: inline-block !important;
        width: auto !important;
        max-width: calc(100vw - 2rem) !important;
        align-self: center !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    .luxury-teaser-section .mobile-underline-fit::after {
        left: 50% !important;
        right: auto !important;
        width: 4.75rem !important;
        transform: translateX(-50%) !important;
    }

    /* Keep title + underline stacked to text width on mobile */
    .experiences-section-title-stack {
        width: fit-content !important;
        max-width: 100% !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    .experiences-section h2,
    .experiences-section .experiences-section-title {
        width: fit-content !important;
        max-width: 100%;
        margin-left: auto !important;
        margin-right: auto !important;
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

    .experiences-section .experience-grid .experience-card,
    .experiences-section .experience-grid .experience-card .experience-image {
        transition-duration: 0.01ms !important;
    }

    .experiences-section .experience-grid .experience-card:hover {
        transform: none;
    }

    .experiences-section .experience-grid .experience-card:hover .experience-image {
        transform: none;
    }
}

</style>