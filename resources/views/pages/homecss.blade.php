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
    .hero-eco-callout {
        bottom: 1.35rem;
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

    /* Keep decorative underlines to text width on mobile titles */
    .experiences-section h2 {
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
}

</style>