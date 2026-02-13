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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--color-off-white)] text-[var(--color-earth-brown)] font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <x-navigation />

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <x-footer />
    </div>
</body>
</html>
