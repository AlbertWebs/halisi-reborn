@extends('layouts.app')

@section('title', 'Contact Us - Halisi Africa Discoveries')
@section('description', 'Get in touch with Halisi Africa to design your authentic African journey.')

@section('content')
    <!-- Hero Banner -->
    <section class="relative min-h-[60vh] flex items-center justify-center bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)] text-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent z-0"></div>
        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-6">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif font-bold mb-6 text-balance leading-tight">
                Let's Design Your Journey
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto leading-relaxed">
                Get in touch with our team to discuss your interests, travel style, and how we can create a bespoke experience that aligns with your values.
            </p>
        </div>
    </section>

    <!-- Journey/Country Context -->
    @if(isset($journey) || isset($country))
    <section class="section-padding bg-white border-b border-[var(--color-sand-beige)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @isset($journey)
                <div class="bg-[var(--color-off-white)] p-6 rounded-lg border-l-4 border-[var(--color-accent-gold)] shadow-sm">
                    <p class="text-xs uppercase tracking-wide text-[var(--color-forest-green)] font-semibold mb-2">Enquiring About</p>
                    <h2 class="text-2xl font-serif font-bold text-[var(--color-forest-green)] mb-3">
                        {{ $journey->title }}
                    </h2>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed">
                        {{ Str::limit(strip_tags($journey->narrative_intro), 150) }}
                    </p>
                </div>
                @endisset

                @isset($country)
                <div class="bg-[var(--color-off-white)] p-6 rounded-lg border-l-4 border-[var(--color-accent-gold)] shadow-sm">
                    <p class="text-xs uppercase tracking-wide text-[var(--color-forest-green)] font-semibold mb-2">Interested In</p>
                    <h2 class="text-2xl font-serif font-bold text-[var(--color-forest-green)] mb-3">
                        {{ $country->name }}
                    </h2>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed">
                        {{ Str::limit(strip_tags($country->country_narrative), 150) }}
                    </p>
                </div>
                @endisset

            </div>
        </div>
    </section>
    @endif

    <!-- Contact Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                <!-- Contact Information -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-lg shadow-md sticky top-24">
                        <h2 class="text-2xl md:text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                            Get In Touch
                        </h2>

                        <div class="space-y-6">
                            @php
                                $companyEmail = \App\Models\SiteSetting::get('company_email', 'info@halisiafrica.com');
                                $companyPhone = \App\Models\SiteSetting::get('company_phone', '+254 700 000 000');
                                $companyAddress = \App\Models\SiteSetting::get('company_address', 'PO Box 1234');
                                $companyCity = \App\Models\SiteSetting::get('company_city', 'Nairobi');
                                $companyCountry = \App\Models\SiteSetting::get('company_country', 'Kenya');
                                $officeHours = \App\Models\SiteSetting::get('office_hours', 'Mon–Fri: 09:00 — 17:00');
                                $socialFacebook = \App\Models\SiteSetting::get('social_facebook', '');
                                $socialInstagram = \App\Models\SiteSetting::get('social_instagram', '');
                                $socialTwitter = \App\Models\SiteSetting::get('social_twitter', '');
                                $socialLinkedin = \App\Models\SiteSetting::get('social_linkedin', '');
                            @endphp

                            @if($companyEmail)
                            <div>
                                <p class="text-sm font-semibold text-[var(--color-forest-green)] uppercase tracking-wide">Email</p>
                                <a href="mailto:{{ $companyEmail }}" class="text-[var(--color-earth-brown)]">
                                    {{ $companyEmail }}
                                </a>
                            </div>
                            @endif

                            @if($companyPhone)
                            <div>
                                <p class="text-sm font-semibold text-[var(--color-forest-green)] uppercase tracking-wide">Phone</p>
                                <a href="tel:{{ $companyPhone }}" class="text-[var(--color-earth-brown)]">
                                    {{ $companyPhone }}
                                </a>
                            </div>
                            @endif

                            @if($companyAddress || $companyCity || $companyCountry)
                            <div>
                                <p class="text-sm font-semibold text-[var(--color-forest-green)] uppercase tracking-wide">Address</p>
                                <p class="text-[var(--color-earth-brown)]">
                                    @if($companyAddress){{ $companyAddress }}<br>@endif
                                    @if($companyCity){{ $companyCity }}@endif
                                    @if($companyCity && $companyCountry), @endif
                                    {{ $companyCountry }}
                                </p>
                            </div>
                            @endif

                            <div>
                                <p class="text-sm font-semibold text-[var(--color-forest-green)] uppercase tracking-wide">Office Hours</p>
                                <p class="text-[var(--color-earth-brown)]">{{ $officeHours }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-[var(--color-forest-green)] uppercase tracking-wide">Follow Us</p>
                                <div class="flex items-center space-x-3 mt-2">
                                    @if($socialFacebook)
                                        <a href="{{ $socialFacebook }}" target="_blank" rel="noopener" aria-label="Facebook" title="Facebook" class="text-gray-400 hover:text-white">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07c0 4.99 3.66 9.12 8.44 9.93v-7.03H8.9v-2.9h1.54V9.8c0-1.52.9-2.36 2.28-2.36.66 0 1.35.12 1.35.12v1.49h-.76c-.75 0-.98.47-.98.95v1.15h1.67l-.27 2.9h-1.4V22c4.78-.81 8.44-4.94 8.44-9.93z"/></svg>
                                            <span class="sr-only">Facebook</span>
                                        </a>
                                    @endif
                                    @if($socialInstagram)
                                        <a href="{{ $socialInstagram }}" target="_blank" rel="noopener" aria-label="Instagram" title="Instagram" class="text-gray-400 hover:text-white">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke-width="2" fill="currentColor"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/></svg>
                                            <span class="sr-only">Instagram</span>
                                        </a>
                                    @endif
                                    @if($socialTwitter)
                                        <a href="{{ $socialTwitter }}" target="_blank" rel="noopener" aria-label="Twitter" title="Twitter" class="text-gray-400 hover:text-white">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.26 4.26 0 001.88-2.36 8.48 8.48 0 01-2.7 1.03 4.24 4.24 0 00-7.23 3.86A12.03 12.03 0 013 4.79a4.24 4.24 0 001.31 5.66c-.64-.02-1.25-.2-1.78-.5v.05c0 2.1 1.49 3.85 3.46 4.25-.36.1-.74.15-1.13.15-.28 0-.55-.03-.82-.08a4.25 4.25 0 003.96 2.95A8.5 8.5 0 012 19.54a12 12 0 006.5 1.9c7.8 0 12.07-6.46 12.07-12.07v-.55A8.6 8.6 0 0024 6.6a8.3 8.3 0 01-2.4.66z"/></svg>
                                            <span class="sr-only">Twitter</span>
                                        </a>
                                    @endif
                                    @if($socialLinkedin)
                                        <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn" title="LinkedIn" class="text-gray-400 hover:text-white">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM0 8.98h5V24H0zM8 8.98h4.8v2.05h.07c.67-1.27 2.3-2.61 4.73-2.61C23.6 8.42 24 11.05 24 14.48V24h-5V15.7c0-2.02-.04-4.62-2.82-4.62-2.82 0-3.25 2.2-3.25 4.47V24H8z"/></svg>
                                            <span class="sr-only">LinkedIn</span>
                                        </a>
                                    @endif
                                </div>
                                <!--  -->
                               <!-- Social Icons -->
                                <div class="flex gap-4">
                                    <a href="{{ $socialFacebook }}" class="w-10 h-10 bg-white/10 border border-white/20 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200" aria-label="Facebook">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                    <a href="#{{ $socialInstagram }}" class="w-10 h-10 bg-white/10 border border-white/20 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200" aria-label="Instagram">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ $socialTwitter }}" class="w-10 h-10 bg-white/10 border border-white/20 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200" aria-label="Twitter">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ $socialLinkedin }}" class="w-10 h-10 bg-white/10 border border-white/20 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200" aria-label="LinkedIn">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-8 md:p-10 rounded-lg shadow-md">
                        <h2 class="text-2xl md:text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                            Send Us a Message
                        </h2>

                        <form method="POST" action="#" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-sm font-medium text-[var(--color-forest-green)]">Name *</label>
                                <input type="text" id="name" name="name" required class="w-full px-4 py-3 border rounded-lg">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-[var(--color-forest-green)]">Email *</label>
                                <input type="email" id="email" name="email" required class="w-full px-4 py-3 border rounded-lg">
                            </div>

                            @isset($journey)
                                <input type="hidden" name="journey_id" value="{{ $journey->id }}">
                            @endisset

                            @isset($country)
                                <input type="hidden" name="country_id" value="{{ $country->id }}">
                            @endisset

                            <div>
                                <label for="message" class="block text-sm font-medium text-[var(--color-forest-green)]">Message *</label>
                                <textarea id="message" name="message" rows="6" required class="w-full px-4 py-3 border rounded-lg"></textarea>
                            </div>

                            <button type="submit" class="px-8 py-4 bg-[var(--color-forest-green)] text-white font-semibold uppercase">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Map Section -->
<div class="mt-10">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8171118.189420204!2d37.908293199999996!3d0.15456044999999977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xe145849f15414bf%3A0x437aa8a42154d!2sHalisi%20Africa%20Discoveries!5e0!3m2!1sen!2ske!4v1771327531896!5m2!1sen!2ske"
            class="w-full h-[400px] rounded-lg border-0"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

@endsection
