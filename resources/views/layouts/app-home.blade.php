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

    <!-- Mobile Bottom Nav (outside wrapper so overflow/transform on homepage don't affect fixed positioning) -->
    <x-mobile-bottom-nav />
</body>
</html>
