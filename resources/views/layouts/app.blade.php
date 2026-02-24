<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Halisi Africa Discoveries')</title>
    <meta name="description" content="@yield('description', 'Authentic African Journeys, Designed to Regenerate')">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Halisi Africa Discoveries')">
    <meta property="og:description" content="@yield('description', 'Authentic African Journeys, Designed to Regenerate')">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Halisi Africa Discoveries')">
    <meta property="twitter:description" content="@yield('description', 'Authentic African Journeys, Designed to Regenerate')">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/favicon.ico') }}">
    
    <!-- Open Graph Image -->
    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
        <meta property="twitter:image" content="@yield('og_image')">
    @else
        <meta property="og:image" content="{{ url('/og-image.jpg') }}">
        <meta property="twitter:image" content="{{ url('/og-image.jpg') }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    
    <!-- Structured Data - Organization -->
    <x-structured-data type="organization" />
    
    @stack('structured_data')
</head>
<body class="site-frontend bg-[var(--color-off-white)] text-[var(--color-earth-brown)] font-sans antialiased {{ request()->routeIs('home') ? 'homepage-body' : '' }} {{ request()->routeIs('countries.show') ? 'country-page-body' : '' }}">
    <!-- Skip to Main Content -->
    <a href="#main-content" class="skip-to-main">Skip to main content</a>
    
    <div class="min-h-screen flex flex-col {{ request()->routeIs('home') ? 'homepage-main-wrapper' : '' }} {{ request()->routeIs('countries.show') ? 'country-page-main-wrapper' : '' }}">
        <!-- Navigation -->
        <x-navigation />

        <!-- Main Content -->
        <main id="main-content" class="flex-grow md:pb-0 pb-20 {{ request()->routeIs('home') ? 'overflow-x-hidden homepage-main-content' : '' }} {{ request()->routeIs('countries.show') ? 'overflow-x-hidden country-page-main-content' : '' }}" role="main" >
            @yield('content')
        </main>

        <!-- Footer -->
        <x-footer />
    </div>

    @if(!request()->routeIs('home'))
        <button
            type="button"
            id="back-to-top-btn"
            class="back-to-hero-arrow fixed bottom-20 md:bottom-8 right-4 md:right-8 z-30 w-12 h-12 md:w-14 md:h-14 rounded-full bg-[var(--color-nav-active)] text-white shadow-lg hover:bg-[var(--color-forest-green)] focus:outline-none focus:ring-2 focus:ring-[var(--color-nav-active)] focus:ring-offset-2 flex items-center justify-center transition-all duration-300 opacity-0 pointer-events-none"
            aria-label="Back to top"
        >
            <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const backToTopBtn = document.getElementById('back-to-top-btn');
                if (!backToTopBtn) {
                    return;
                }

                const toggleBackToTop = function () {
                    if (window.scrollY > window.innerHeight * 0.4) {
                        backToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                    } else {
                        backToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                    }
                };

                backToTopBtn.addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });

                window.addEventListener('scroll', toggleBackToTop, { passive: true });
                toggleBackToTop();
            });
        </script>
    @endif

    <!-- Scroll-triggered animations (all pages) -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof window.IntersectionObserver === 'undefined') {
            document.querySelectorAll('.js-scroll, .js-scroll-stagger').forEach(function(el) { el.classList.add('is-visible'); });
            return;
        }
        var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var els = document.querySelectorAll('.js-scroll, .js-scroll-stagger');
        if (reducedMotion) {
            els.forEach(function(el) { el.classList.add('is-visible'); });
            return;
        }
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { rootMargin: '0px 0px -40px 0px', threshold: 0.05 });
        els.forEach(function(el) { observer.observe(el); });
    });
    </script>

    <!-- Mobile Bottom Nav (outside wrapper so overflow/transform on homepage don't affect fixed positioning) -->
    <x-mobile-bottom-nav />
</body>
</html>
