@php
    $footerLogo = \App\Models\SiteSetting::get('logo_main') ?: \App\Models\SiteSetting::get('logo_footer');
    $companyName = \App\Models\SiteSetting::get('company_name', 'Halisi Africa Discoveries');
    $newsletterPopupEnabled = \App\Models\SiteSetting::get('newsletter_popup_enabled', '0') === '1';
    $newsletterPopupDelay = (int) \App\Models\SiteSetting::get('newsletter_popup_delay_seconds', '10');
    $newsletterPopupDelay = $newsletterPopupDelay > 0 ? $newsletterPopupDelay : 10;
    $newsletterPopupTitle = \App\Models\SiteSetting::get('newsletter_popup_title', 'Stay Connected with Halisi');
    $newsletterPopupDescription = \App\Models\SiteSetting::get('newsletter_popup_description', 'Get travel inspiration, impact stories, and curated journey ideas.');
    $newsletterPopupButtonLabel = \App\Models\SiteSetting::get('newsletter_popup_button_label', 'Subscribe');

    $newsletterChallengeLeft = random_int(1, 9);
    $newsletterChallengeRight = random_int(1, 9);
    session([
        'newsletter_math_answer' => $newsletterChallengeLeft + $newsletterChallengeRight,
        'newsletter_math_expires_at' => now()->addMinutes(15)->timestamp,
    ]);
@endphp

<footer class="bg-gradient-to-b from-[var(--color-forest-green)] to-[#133629] text-white mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-20 md:py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-10 mb-12">
            <!-- Brand & Newsletter -->
            <div class="lg:col-span-2">
                @if($footerLogo)
                    <a href="{{ route('home') }}" class="inline-block mb-7">
                        <img
                            src="{{ asset('storage/' . $footerLogo) }}"
                            alt="{{ $companyName }}"
                            class="h-12 md:h-20 w-auto object-contain"
                        >
                    </a>
                @else
                    <h3 class="text-3xl font-serif font-bold tracking-tight text-white/95 mb-7">{{ $companyName }}</h3>
                @endif
                
                <!-- Newsletter Signup -->
                <div class="mb-7">
                    <h4 class="font-semibold mb-3 text-[0.68rem] uppercase tracking-[0.18em] text-white/75">Stay Connected</h4>
                    @if(session('newsletter_success'))
                        <div class="mb-3 rounded-md border border-green-200 bg-green-50 px-3 py-2 text-sm text-green-800">
                            {{ session('newsletter_success') }}
                        </div>
                    @endif
                    @if($errors->newsletterForm->any())
                        <div class="mb-3 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-800">
                            {{ $errors->newsletterForm->first() }}
                        </div>
                    @endif
                    <form class="flex flex-col gap-3" method="POST" action="{{ route('newsletter.subscribe') }}" aria-label="Newsletter subscription">
                        @csrf
                        <input type="hidden" name="source" value="footer">
                        <input type="hidden" name="rendered_at" value="{{ time() }}">
                        <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">
                        <label for="newsletter-email" class="sr-only">Email address</label>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                            <input
                                type="email"
                                id="newsletter-email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Your email address"
                                class="flex-1 px-4 py-2.5 bg-white/10 border border-white/20 rounded-lg text-white placeholder:text-white/45 focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:border-[var(--color-accent-gold)]"
                                required
                                aria-required="true"
                            >
                            <button
                                type="submit"
                                class="w-full sm:w-auto px-6 py-2.5 bg-[var(--color-accent-gold)] text-[var(--color-forest-green)] font-semibold tracking-wide rounded-lg hover:bg-[#e8c57a] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:ring-offset-2 transition-colors"
                                aria-label="Subscribe to newsletter"
                            >
                                Subscribe
                            </button>
                        </div>
                        <div>
                            <label for="newsletter_challenge_answer" class="block text-xs text-white/80 mb-1">
                                What is {{ $newsletterChallengeLeft }} + {{ $newsletterChallengeRight }}?
                            </label>
                            <input
                                type="number"
                                id="newsletter_challenge_answer"
                                name="challenge_answer"
                                min="0"
                                required
                                class="w-full sm:w-48 px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder:text-white/45 focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:border-[var(--color-accent-gold)]"
                            >
                        </div>
                    </form>
                </div>
                
                <!-- Social Icons -->
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 bg-white/10 border border-white/20 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200" aria-label="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 border border-white/20 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200" aria-label="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 border border-white/20 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200" aria-label="Twitter">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 border border-white/20 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200" aria-label="LinkedIn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-semibold mb-5 text-[0.68rem] uppercase tracking-[0.18em] text-white/75">Quick Links</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">About</a></li>
                    <li><a href="{{ route('countries.index') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Explore Africa</a></li>
                    <li><a href="{{ route('work.index') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Work With Us</a></li>
                    <li><a href="{{ route('contact.index') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Journeys -->
            <div>
                <h4 class="font-semibold mb-5 text-[0.68rem] uppercase tracking-[0.18em] text-white/75">Journeys</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('journeys.index') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">All Journeys</a></li>
                    <li><a href="{{ route('journeys.signature-safaris') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Signature Safaris</a></li>
                    <li><a href="{{ route('journeys.bespoke-private') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Bespoke Private Travel</a></li>
                    <li><a href="{{ route('journeys.luxury-retreats') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Luxury Retreats</a></li>
                    <li><a href="{{ route('journeys.conservation-community') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Conservation & Community</a></li>
                </ul>
            </div>

            <!-- Impact & Destinations -->
            <div>
                <h4 class="font-semibold mb-5 text-[0.68rem] uppercase tracking-[0.18em] text-white/75">Impact & Destinations</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('trust.index') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Halisi Trust</a></li>
                    <li><a href="{{ route('impact.responsible-travel') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Responsible Travel</a></li>
                    <li><a href="{{ route('impact.climate-community') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Climate & Community</a></li>
                    <li><a href="{{ route('countries.index') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">All Countries</a></li>
                    <li><a href="{{ route('countries.kenya') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Kenya</a></li>
                    <li><a href="{{ route('countries.uganda') }}" class="text-white/80 hover:text-[var(--color-accent-gold)] transition-colors">Uganda</a></li>
                </ul>
            </div>
        </div>

        <!-- Certifications -->
        <div class="pt-8 border-t border-white/15">
            <p class="text-[0.68rem] uppercase tracking-[0.18em] text-white/70 mb-5">Certified by:</p>
            <div class="flex flex-wrap gap-3 items-center justify-center md:justify-start">
                <!-- Partner logos - replace placeholders with actual logo images -->
                <!-- Logos should be equal height, grayscale/muted, not overpower brand -->
                <div class="px-3 py-1.5 rounded-full border border-white/20 bg-white/5 opacity-80 hover:opacity-100 hover:border-white/35 transition-all">
                    <span class="text-xs text-white/75">Tripadvisor</span>
                    <!-- <img src="/images/partners/tripadvisor.svg" alt="Tripadvisor" class="h-8 w-auto grayscale opacity-60"> -->
                </div>
                <div class="px-3 py-1.5 rounded-full border border-white/20 bg-white/5 opacity-80 hover:opacity-100 hover:border-white/35 transition-all">
                    <span class="text-xs text-white/75">SafariBookings</span>
                    <!-- <img src="/images/partners/safaribookings.svg" alt="SafariBookings" class="h-8 w-auto grayscale opacity-60"> -->
                </div>
                <div class="px-3 py-1.5 rounded-full border border-white/20 bg-white/5 opacity-80 hover:opacity-100 hover:border-white/35 transition-all">
                    <span class="text-xs text-white/75">Regenerative Travel</span>
                    <!-- <img src="/images/partners/regenerative-travel.svg" alt="Regenerative Travel" class="h-8 w-auto grayscale opacity-60"> -->
                </div>
                <div class="px-3 py-1.5 rounded-full border border-white/20 bg-white/5 opacity-80 hover:opacity-100 hover:border-white/35 transition-all">
                    <span class="text-xs text-white/75">Equality in Tourism</span>
                    <!-- <img src="/images/partners/equality-tourism.svg" alt="Equality in Tourism" class="h-8 w-auto grayscale opacity-60"> -->
                </div>
                <div class="px-3 py-1.5 rounded-full border border-white/20 bg-white/5 opacity-80 hover:opacity-100 hover:border-white/35 transition-all">
                    <span class="text-xs text-white/75">Climate Friendly Travel</span>
                    <!-- <img src="/images/partners/climate-friendly.svg" alt="Climate Friendly Travel Services" class="h-8 w-auto grayscale opacity-60"> -->
                </div>
            </div>
        </div>

        <!-- Copyright & Legal -->
        <div class="mt-8 pt-8 border-t border-white/15">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-white/55">
                <p class="tracking-wide">&copy; {{ date('Y') }} Halisi Africa Discoveries. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="{{ route('privacy-policy') }}" class="text-white/60 hover:text-[var(--color-accent-gold)] transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms-and-conditions') }}" class="text-white/60 hover:text-[var(--color-accent-gold)] transition-colors">Terms & Conditions</a>
                    <a href="{{ route('media-credits') }}" class="text-white/60 hover:text-[var(--color-accent-gold)] transition-colors">Media Credits</a>
                </div>
            </div>
        </div>
    </div>
</footer>

@if($newsletterPopupEnabled)
    <div id="newsletter-popup-overlay" class="fixed inset-0 z-[120] bg-black/50 hidden"></div>
    <div id="newsletter-popup" class="fixed inset-x-4 bottom-4 z-[130] mx-auto max-w-lg rounded-2xl border border-[var(--color-sand-beige)] bg-white p-6 shadow-2xl hidden">
        <button type="button" id="newsletter-popup-close" class="absolute right-3 top-3 rounded-full p-1 text-gray-500 hover:bg-gray-100" aria-label="Close popup">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h3 class="text-2xl font-serif font-bold text-[var(--color-forest-green)] mb-2">{{ $newsletterPopupTitle }}</h3>
        <p class="text-sm text-[var(--color-earth-brown)] mb-4">{{ $newsletterPopupDescription }}</p>

        <form method="POST" action="{{ route('newsletter.subscribe') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="source" value="popup">
            <input type="hidden" name="rendered_at" value="{{ time() }}">
            <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">
            <div>
                <label for="newsletter-popup-email" class="sr-only">Email address</label>
                <input type="email" id="newsletter-popup-email" name="email" required placeholder="Your email address"
                    class="w-full rounded-lg border border-[var(--color-sand-beige)] px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)]">
            </div>
            <div>
                <label for="newsletter-popup-challenge" class="block text-xs text-[var(--color-earth-brown)] mb-1">
                    What is {{ $newsletterChallengeLeft }} + {{ $newsletterChallengeRight }}?
                </label>
                <input type="number" id="newsletter-popup-challenge" name="challenge_answer" min="0" required
                    class="w-full rounded-lg border border-[var(--color-sand-beige)] px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)]">
            </div>
            <button type="submit" class="inline-flex items-center rounded-full bg-[var(--color-forest-green)] px-6 py-3 text-white font-semibold hover:bg-[var(--color-earth-brown)] transition-colors">
                {{ $newsletterPopupButtonLabel }}
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (sessionStorage.getItem('newsletter_popup_dismissed') === '1') {
                return;
            }

            const popup = document.getElementById('newsletter-popup');
            const overlay = document.getElementById('newsletter-popup-overlay');
            const closeBtn = document.getElementById('newsletter-popup-close');

            if (!popup || !overlay || !closeBtn) {
                return;
            }

            const showPopup = function () {
                popup.classList.remove('hidden');
                overlay.classList.remove('hidden');
            };

            const hidePopup = function () {
                popup.classList.add('hidden');
                overlay.classList.add('hidden');
                sessionStorage.setItem('newsletter_popup_dismissed', '1');
            };

            setTimeout(showPopup, {{ $newsletterPopupDelay * 1000 }});
            closeBtn.addEventListener('click', hidePopup);
            overlay.addEventListener('click', hidePopup);
        });
    </script>
@endif
