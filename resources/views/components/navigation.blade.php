@php
    $isHomepage = request()->routeIs('home');
    $logoMain = \App\Models\SiteSetting::get('logo_main');
    $companyName = \App\Models\SiteSetting::get('company_name', 'Halisi Africa');
@endphp

<nav class="{{ $isHomepage ? 'absolute top-0 left-0 right-0 bg-transparent z-50 w-full nav-homepage' : 'bg-white border-b border-[var(--color-sand-beige)] sticky top-0 z-50 w-full' }}">
    <div class="{{ $isHomepage ? 'w-full px-4 sm:px-6 lg:px-8 nav-container-homepage' : 'w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8' }}">
        <div class="flex justify-between items-center {{ $isHomepage ? 'h-20' : 'h-16' }}">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    @if($logoMain)
                        <img src="{{ asset('storage/' . $logoMain) }}" 
                             alt="{{ $companyName }}" 
                             class="h-20 object-contain {{ $isHomepage ? '' : '' }}">
                    @else
                        <span class="text-4xl font-serif font-bold {{ $isHomepage ? 'text-white' : 'text-[var(--color-forest-green)]' }}">
                            {{ $companyName }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('about') }}" class="text-[0.9rem] font-medium uppercase {{ $isHomepage ? 'text-white hover:text-gray-200' : 'text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)]' }} transition-colors relative group">
                    <span class="relative pb-1">
                        About Halisi
                        <span class="absolute bottom-0 left-0 w-full h-px bg-current opacity-40 transition-opacity duration-300 group-hover:opacity-100"></span>
                    </span>
                </a>

                <!-- Journeys Dropdown -->
                <div class="relative group">
                    <button class="text-[0.9rem] font-medium uppercase {{ $isHomepage ? 'text-white hover:text-gray-200' : 'text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)]' }} transition-colors flex items-center relative">
                        <span class="relative pb-1">
                            Journeys
                            <span class="absolute bottom-0 left-0 w-full h-px bg-current opacity-40 transition-opacity duration-300 group-hover:opacity-100"></span>
                        </span>
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="py-1">
                            <a href="{{ route('journeys.index') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">All Journeys</a>
                            <a href="{{ route('journeys.signature-safaris') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Signature Safaris</a>
                            <a href="{{ route('journeys.bespoke-private') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Bespoke Private Travel</a>
                            <a href="{{ route('journeys.conservation-community') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Conservation & Community</a>
                            <a href="{{ route('journeys.luxury-retreats') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Luxury Retreats</a>
                        </div>
                    </div>
                </div>

                <!-- Countries Dropdown -->
                <div class="relative group">
                    <button class="text-[0.9rem] font-medium uppercase {{ $isHomepage ? 'text-white hover:text-gray-200' : 'text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)]' }} transition-colors flex items-center relative">
                        <span class="relative pb-1">
                            Explore Africa
                            <span class="absolute bottom-0 left-0 w-full h-px bg-current opacity-40 transition-opacity duration-300 group-hover:opacity-100"></span>
                        </span>
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="py-1">
                            <a href="{{ route('countries.index') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">All Countries</a>
                            <a href="{{ route('countries.kenya') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Kenya</a>
                            <a href="{{ route('countries.uganda') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Uganda</a>
                            <a href="{{ route('countries.tanzania') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Tanzania</a>
                            <a href="{{ route('countries.zambia') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Zambia</a>
                            <a href="{{ route('countries.zimbabwe') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Zimbabwe</a>
                            <a href="{{ route('countries.botswana') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Botswana</a>
                            <a href="{{ route('countries.namibia') }}" class="block px-4 py-2 text-sm hover:bg-[var(--color-sand-beige)]">Namibia</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('impact.responsible-travel') }}" class="text-[0.9rem] font-medium uppercase {{ $isHomepage ? 'text-white hover:text-gray-200' : 'text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)]' }} transition-colors relative group">
                    <span class="relative pb-1">
                        Impact
                        <span class="absolute bottom-0 left-0 w-full h-px bg-current opacity-40 transition-opacity duration-300 group-hover:opacity-100"></span>
                    </span>
                </a>

                <a href="{{ route('trust.index') }}" class="text-[0.9rem] font-medium uppercase {{ $isHomepage ? 'text-white hover:text-gray-200' : 'text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)]' }} transition-colors relative group">
                    <span class="relative pb-1">
                        Halisi Trust
                        <span class="absolute bottom-0 left-0 w-full h-px bg-current opacity-40 transition-opacity duration-300 group-hover:opacity-100"></span>
                    </span>
                </a>

                <a href="{{ route('work.index') }}" class="text-[0.9rem] font-medium uppercase {{ $isHomepage ? 'text-white hover:text-gray-200' : 'text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)]' }} transition-colors relative group">
                    <span class="relative pb-1">
                        Work With Us
                        <span class="absolute bottom-0 left-0 w-full h-px bg-current opacity-40 transition-opacity duration-300 group-hover:opacity-100"></span>
                    </span>
                </a>

                <a href="{{ route('contact.index') }}" class="text-[0.9rem] font-semibold uppercase transition-colors rounded-sm px-4 py-2 border bg-[var(--color-accent-gold)] border-[var(--color-accent-gold)] text-[var(--color-forest-green)] hover:bg-[var(--color-sand-beige)] hover:border-[var(--color-sand-beige)]">
                        Contact
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button" 
                        class="{{ $isHomepage ? 'text-white' : 'text-[var(--color-forest-green)]' }} focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:ring-offset-2 rounded p-2" 
                        id="mobile-menu-button"
                        aria-label="Toggle mobile menu"
                        aria-expanded="false"
                        aria-controls="mobile-menu">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden" id="mobile-menu" role="navigation" aria-label="Mobile navigation">
        <div class="px-2 pt-2 pb-3 space-y-1 {{ $isHomepage ? 'bg-black/80 backdrop-blur-sm' : 'bg-white border-t border-[var(--color-sand-beige)]' }}">
            <a href="{{ route('about') }}" class="block px-3 py-2 text-base font-medium {{ $isHomepage ? 'text-white' : '' }}">About Halisi</a>
            <a href="{{ route('journeys.index') }}" class="block px-3 py-2 text-base font-medium {{ $isHomepage ? 'text-white' : '' }}">Journeys</a>
            <a href="{{ route('countries.index') }}" class="block px-3 py-2 text-base font-medium {{ $isHomepage ? 'text-white' : '' }}">Explore Africa</a>
            <a href="{{ route('impact.responsible-travel') }}" class="block px-3 py-2 text-base font-medium {{ $isHomepage ? 'text-white' : '' }}">Impact</a>
            <a href="{{ route('trust.index') }}" class="block px-3 py-2 text-base font-medium {{ $isHomepage ? 'text-white' : '' }}">Halisi Trust</a>
            <a href="{{ route('work.index') }}" class="block px-3 py-2 text-base font-medium {{ $isHomepage ? 'text-white' : '' }}">Work With Us</a>
            <a href="{{ route('contact.index') }}" class="block px-3 py-2 text-base font-semibold rounded-sm border bg-[var(--color-accent-gold)] border-[var(--color-accent-gold)] text-[var(--color-forest-green)] hover:bg-[var(--color-sand-beige)] hover:border-[var(--color-sand-beige)]">Contact</a>
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
