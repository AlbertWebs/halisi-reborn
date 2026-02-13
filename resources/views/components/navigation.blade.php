<nav class="bg-white border-b border-[var(--color-sand-beige)] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-2xl font-serif font-bold text-[var(--color-forest-green)]">
                    Halisi Africa
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-sm font-medium hover:text-[var(--color-forest-green)] transition-colors">
                    Home
                </a>
                
                <a href="{{ route('about') }}" class="text-sm font-medium hover:text-[var(--color-forest-green)] transition-colors">
                    About Halisi
                </a>

                <!-- Journeys Dropdown -->
                <div class="relative group">
                    <button class="text-sm font-medium hover:text-[var(--color-forest-green)] transition-colors flex items-center">
                        Journeys
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
                    <button class="text-sm font-medium hover:text-[var(--color-forest-green)] transition-colors flex items-center">
                        Explore Africa
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

                <a href="{{ route('impact.responsible-travel') }}" class="text-sm font-medium hover:text-[var(--color-forest-green)] transition-colors">
                    Impact
                </a>

                <a href="{{ route('trust.index') }}" class="text-sm font-medium hover:text-[var(--color-forest-green)] transition-colors">
                    Halisi Trust
                </a>

                <a href="{{ route('work.index') }}" class="text-sm font-medium hover:text-[var(--color-forest-green)] transition-colors">
                    Work With Us
                </a>

                <a href="{{ route('contact.index') }}" class="text-sm font-medium hover:text-[var(--color-forest-green)] transition-colors">
                    Contact
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button" 
                        class="text-[var(--color-forest-green)] focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:ring-offset-2 rounded p-2" 
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
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-[var(--color-sand-beige)]">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium">Home</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 text-base font-medium">About Halisi</a>
            <a href="{{ route('journeys.index') }}" class="block px-3 py-2 text-base font-medium">Journeys</a>
            <a href="{{ route('countries.index') }}" class="block px-3 py-2 text-base font-medium">Explore Africa</a>
            <a href="{{ route('impact.responsible-travel') }}" class="block px-3 py-2 text-base font-medium">Impact</a>
            <a href="{{ route('trust.index') }}" class="block px-3 py-2 text-base font-medium">Halisi Trust</a>
            <a href="{{ route('work.index') }}" class="block px-3 py-2 text-base font-medium">Work With Us</a>
            <a href="{{ route('contact.index') }}" class="block px-3 py-2 text-base font-medium">Contact</a>
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
