<footer class="bg-[var(--color-forest-green)] text-white mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-2xl font-serif font-bold mb-4">Halisi Africa Discoveries</h3>
                <p class="text-sm text-gray-300 mb-4">Authentic African Journeys, Designed to Regenerate</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-[var(--color-accent-gold)] transition-colors">About</a></li>
                    <li><a href="{{ route('journeys.index') }}" class="hover:text-[var(--color-accent-gold)] transition-colors">Journeys</a></li>
                    <li><a href="{{ route('countries.index') }}" class="hover:text-[var(--color-accent-gold)] transition-colors">Countries</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-[var(--color-accent-gold)] transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Impact -->
            <div>
                <h4 class="font-semibold mb-4">Impact</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('trust.index') }}" class="hover:text-[var(--color-accent-gold)] transition-colors">Halisi Trust</a></li>
                    <li><a href="{{ route('impact.responsible-travel') }}" class="hover:text-[var(--color-accent-gold)] transition-colors">Responsible Travel</a></li>
                    <li><a href="{{ route('impact.climate-community') }}" class="hover:text-[var(--color-accent-gold)] transition-colors">Climate & Community</a></li>
                </ul>
            </div>
        </div>

        <!-- Certifications -->
        <div class="mt-8 pt-8 border-t border-gray-700">
            <p class="text-sm text-gray-300 mb-4">Certified by:</p>
            <div class="flex flex-wrap gap-6 items-center">
                <!-- Placeholder logos - replace with actual images -->
                <div class="text-xs text-gray-400">Tripadvisor</div>
                <div class="text-xs text-gray-400">SafariBookings</div>
                <div class="text-xs text-gray-400">Regenerative Travel</div>
                <div class="text-xs text-gray-400">Equality in Tourism</div>
                <div class="text-xs text-gray-400">Climate Friendly Travel Services</div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 pt-8 border-t border-gray-700 text-center text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} Halisi Africa Discoveries. All rights reserved.</p>
        </div>
    </div>
</footer>
