@php
    $isHomepage = request()->routeIs('home');
    $isCountryPage = request()->routeIs('countries.show') || request()->routeIs('countries.*');
    $hasVideo = false;
    if ($isCountryPage) {
        // Try to get country from route parameter
        $countryParam = request()->route('country');
        if ($countryParam) {
            $countryModel = is_string($countryParam) 
                ? \App\Models\Country::where('slug', $countryParam)->first() 
                : $countryParam;
            if ($countryModel && $countryModel->hero_video) {
                $hasVideo = true;
            }
        }
    }
    $isTransparentNav = $isHomepage || ($isCountryPage && $hasVideo);
    $logoMain = \App\Models\SiteSetting::get('logo_main');
    $logoFooter = \App\Models\SiteSetting::get('logo_footer');
    $navLogo = $isTransparentNav ? ($logoMain ?: $logoFooter) : ($logoFooter ?: $logoMain);
    $companyName = \App\Models\SiteSetting::get('company_name', 'Halisi Africa');
    $activeAbout = request()->routeIs('about');
    $activeJourneys = request()->routeIs('journeys.*');
    $activeCountries = request()->routeIs('countries.*');
    $activeImpact = request()->routeIs('impact.*');
    $activeTrust = request()->routeIs('trust.*');
    $activeWork = request()->routeIs('work.index');
    $activeContact = request()->routeIs('contact.index');
    $navCountries = \App\Models\Country::where('is_published', true)->orderBy('sort_order')->orderBy('name')->get();
@endphp

<nav class="{{ $isTransparentNav ? 'absolute top-0 left-0 right-0 bg-transparent z-50 w-full nav-homepage' : 'bg-white border-b border-[var(--color-sand-beige)] sticky top-0 z-50 w-full' }}">
    <div class="{{ $isTransparentNav ? 'w-full px-4 sm:px-6 lg:px-8 nav-container-homepage' : 'w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8' }}">
        <div class="flex justify-between items-center {{ $isTransparentNav ? 'h-20' : 'h-16' }}">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    @if($navLogo)
                        <img src="{{ asset('storage/' . $navLogo) }}" 
                             alt="{{ $companyName }}" 
                             class="{{ $isHomepage ? 'h-12 md:h-20' : 'h-10 md:h-14' }} object-contain">
                    @else
                        <span class="text-4xl font-serif font-bold {{ $isTransparentNav ? 'text-white' : 'text-black' }}">
                            {{ $companyName }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('about') }}" class="text-[0.9rem] font-medium uppercase {{ $activeAbout ? 'text-[var(--color-nav-active)]' : ($isTransparentNav ? 'text-white hover:text-gray-200' : 'text-black hover:text-[var(--color-nav-active)]') }} transition-colors relative group">
                    <span class="relative pb-1">
                        About Halisi
                        <span class="absolute bottom-0 left-0 w-full {{ $activeAbout ? 'h-px bg-[var(--color-nav-active)] opacity-100' : ($isTransparentNav ? 'h-px bg-current opacity-40 group-hover:opacity-100' : 'h-px bg-black opacity-40 group-hover:bg-[var(--color-nav-active)] group-hover:opacity-100') }} transition-all duration-300"></span>
                    </span>
                </a>

                <!-- Journeys Dropdown -->
                <div class="relative group">
                    <button class="text-[0.9rem] font-medium uppercase {{ $activeJourneys ? 'text-[var(--color-nav-active)]' : ($isTransparentNav ? 'text-white hover:text-gray-200' : 'text-black hover:text-[var(--color-nav-active)]') }} transition-colors flex items-center relative">
                        <span class="relative pb-1">
                            Journeys
                            <span class="absolute bottom-0 left-0 w-full {{ $activeJourneys ? 'h-px bg-[var(--color-nav-active)] opacity-100' : ($isTransparentNav ? 'h-px bg-current opacity-40 group-hover:opacity-100' : 'h-px bg-black opacity-40 group-hover:bg-[var(--color-nav-active)] group-hover:opacity-100') }} transition-all duration-300"></span>
                        </span>
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-[var(--color-sand-beige)]">
                        <div class="py-1">
                            <a href="{{ route('journeys.index') }}" class="block px-4 py-2 text-sm text-[var(--color-earth-brown)] hover:bg-[var(--color-nav-active)]/10 hover:text-[var(--color-nav-active)]">All Journeys</a>
                            <a href="{{ route('journeys.signature-safaris') }}" class="block px-4 py-2 text-sm text-[var(--color-earth-brown)] hover:bg-[var(--color-nav-active)]/10 hover:text-[var(--color-nav-active)]">Signature Safaris</a>
                            <a href="{{ route('journeys.bespoke-private') }}" class="block px-4 py-2 text-sm text-[var(--color-earth-brown)] hover:bg-[var(--color-nav-active)]/10 hover:text-[var(--color-nav-active)]">Bespoke Private Travel</a>
                            <a href="{{ route('journeys.conservation-community') }}" class="block px-4 py-2 text-sm text-[var(--color-earth-brown)] hover:bg-[var(--color-nav-active)]/10 hover:text-[var(--color-nav-active)]">Conservation & Community</a>
                            <a href="{{ route('journeys.luxury-retreats') }}" class="block px-4 py-2 text-sm text-[var(--color-earth-brown)] hover:bg-[var(--color-nav-active)]/10 hover:text-[var(--color-nav-active)]">Luxury Retreats</a>
                        </div>
                    </div>
                </div>

                <!-- Countries Dropdown -->
                <div class="relative group">
                    <button class="text-[0.9rem] font-medium uppercase {{ $activeCountries ? 'text-[var(--color-nav-active)]' : ($isTransparentNav ? 'text-white hover:text-gray-200' : 'text-black hover:text-[var(--color-nav-active)]') }} transition-colors flex items-center relative">
                        <span class="relative pb-1">
                            Explore Africa
                            <span class="absolute bottom-0 left-0 w-full {{ $activeCountries ? 'h-px bg-[var(--color-nav-active)] opacity-100' : ($isTransparentNav ? 'h-px bg-current opacity-40 group-hover:opacity-100' : 'h-px bg-black opacity-40 group-hover:bg-[var(--color-nav-active)] group-hover:opacity-100') }} transition-all duration-300"></span>
                        </span>
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-[var(--color-sand-beige)] max-h-[70vh] overflow-y-auto">
                        <div class="py-1">
                            <a href="{{ route('countries.index') }}" class="block px-4 py-2 text-sm text-[var(--color-earth-brown)] hover:bg-[var(--color-nav-active)]/10 hover:text-[var(--color-nav-active)]">All Countries</a>
                            @foreach($navCountries as $navCountry)
                                <a href="{{ route('countries.show', $navCountry->slug) }}" class="block px-4 py-2 text-sm text-[var(--color-earth-brown)] hover:bg-[var(--color-nav-active)]/10 hover:text-[var(--color-nav-active)]">{{ $navCountry->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ route('impact.responsible-travel') }}" class="text-[0.9rem] font-medium uppercase {{ $activeImpact ? 'text-[var(--color-nav-active)]' : ($isTransparentNav ? 'text-white hover:text-gray-200' : 'text-black hover:text-[var(--color-nav-active)]') }} transition-colors relative group">
                    <span class="relative pb-1">
                        Impact
                        <span class="absolute bottom-0 left-0 w-full {{ $activeImpact ? 'h-px bg-[var(--color-nav-active)] opacity-100' : ($isTransparentNav ? 'h-px bg-current opacity-40 group-hover:opacity-100' : 'h-px bg-black opacity-40 group-hover:bg-[var(--color-nav-active)] group-hover:opacity-100') }} transition-all duration-300"></span>
                    </span>
                </a>

                <a href="{{ route('trust.index') }}" class="text-[0.9rem] font-medium uppercase {{ $activeTrust ? 'text-[var(--color-nav-active)]' : ($isTransparentNav ? 'text-white hover:text-gray-200' : 'text-black hover:text-[var(--color-nav-active)]') }} transition-colors relative group">
                    <span class="relative pb-1">
                        Halisi Trust
                        <span class="absolute bottom-0 left-0 w-full {{ $activeTrust ? 'h-px bg-[var(--color-nav-active)] opacity-100' : ($isTransparentNav ? 'h-px bg-current opacity-40 group-hover:opacity-100' : 'h-px bg-black opacity-40 group-hover:bg-[var(--color-nav-active)] group-hover:opacity-100') }} transition-all duration-300"></span>
                    </span>
                </a>

                <a href="{{ route('work.index') }}" class="text-[0.9rem] font-medium uppercase {{ $activeWork ? 'text-[var(--color-nav-active)]' : ($isTransparentNav ? 'text-white hover:text-gray-200' : 'text-black hover:text-[var(--color-nav-active)]') }} transition-colors relative group">
                    <span class="relative pb-1">
                        Work With Us
                        <span class="absolute bottom-0 left-0 w-full {{ $activeWork ? 'h-px bg-[var(--color-nav-active)] opacity-100' : ($isTransparentNav ? 'h-px bg-current opacity-40 group-hover:opacity-100' : 'h-px bg-black opacity-40 group-hover:bg-[var(--color-nav-active)] group-hover:opacity-100') }} transition-all duration-300"></span>
                    </span>
                </a>

                <a href="{{ route('contact.index') }}" class="text-[0.9rem] font-semibold uppercase transition-colors rounded-sm px-4 py-2 border {{ $activeContact ? 'bg-[var(--color-nav-active)] border-[var(--color-nav-active)] text-white' : ($isTransparentNav ? 'bg-[var(--color-accent-gold)] border-[var(--color-accent-gold)] text-[var(--color-forest-green)] hover:bg-[var(--color-sand-beige)] hover:border-[var(--color-sand-beige)]' : 'bg-transparent border-[var(--color-nav-active)] text-[var(--color-nav-active)] hover:bg-[var(--color-nav-active)] hover:text-white') }}">
                        Contact
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button" 
                        class="{{ $isTransparentNav ? 'text-white' : 'text-black' }} focus:outline-none focus:ring-2 focus:ring-[var(--color-nav-active)] focus:ring-offset-2 rounded p-1.5" 
                        id="mobile-menu-button"
                        aria-label="Toggle mobile menu"
                        aria-expanded="false"
                        aria-controls="mobile-menu">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden" id="mobile-menu" role="navigation" aria-label="Mobile navigation">
        <div class="px-1 pt-1 pb-1.5 space-y-0 {{ $isTransparentNav ? 'bg-black/80 backdrop-blur-sm' : 'bg-white border-t border-[var(--color-sand-beige)]' }}">
            <a href="{{ route('about') }}" class="block px-2 py-1 text-xs font-medium {{ $activeAbout ? 'text-[var(--color-nav-active)] border-l-2 border-[var(--color-nav-active)] pl-2.5 font-semibold' : ($isTransparentNav ? 'text-white' : 'text-black') }}">About Halisi</a>
            <a href="{{ route('journeys.index') }}" class="block px-2 py-1 text-xs font-medium {{ $activeJourneys ? 'text-[var(--color-nav-active)] border-l-2 border-[var(--color-nav-active)] pl-2.5 font-semibold' : ($isTransparentNav ? 'text-white' : 'text-black') }}">Journeys</a>
            <a href="{{ route('countries.index') }}" class="block px-2 py-1 text-xs font-medium {{ $activeCountries ? 'text-[var(--color-nav-active)] border-l-2 border-[var(--color-nav-active)] pl-2.5 font-semibold' : ($isTransparentNav ? 'text-white' : 'text-black') }}">Explore Africa</a>
            <a href="{{ route('impact.responsible-travel') }}" class="block px-2 py-1 text-xs font-medium {{ $activeImpact ? 'text-[var(--color-nav-active)] border-l-2 border-[var(--color-nav-active)] pl-2.5 font-semibold' : ($isTransparentNav ? 'text-white' : 'text-black') }}">Impact</a>
            <a href="{{ route('trust.index') }}" class="block px-2 py-1 text-xs font-medium {{ $activeTrust ? 'text-[var(--color-nav-active)] border-l-2 border-[var(--color-nav-active)] pl-2.5 font-semibold' : ($isTransparentNav ? 'text-white' : 'text-black') }}">Halisi Trust</a>
            <a href="{{ route('work.index') }}" class="block px-2 py-1 text-xs font-medium {{ $activeWork ? 'text-[var(--color-nav-active)] border-l-2 border-[var(--color-nav-active)] pl-2.5 font-semibold' : ($isTransparentNav ? 'text-white' : 'text-black') }}">Work With Us</a>
            <a href="{{ route('contact.index') }}" class="block px-2 py-1 text-xs font-semibold rounded-sm border {{ $activeContact ? 'bg-[var(--color-nav-active)] border-[var(--color-nav-active)] text-white' : ($isTransparentNav ? 'bg-[var(--color-accent-gold)] border-[var(--color-accent-gold)] text-[var(--color-forest-green)] hover:bg-[var(--color-sand-beige)] hover:border-[var(--color-sand-beige)]' : 'bg-transparent border-[var(--color-nav-active)] text-[var(--color-nav-active)]') }}">Contact</a>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        const button = document.getElementById('mobile-menu-button');
        const isHidden = menu.classList.contains('hidden');
        
        menu.classList.toggle('hidden');
        button.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
    });
</script>


