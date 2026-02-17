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
    @if($journey ?? null || $country ?? null)
    <section class="section-padding bg-white border-b border-[var(--color-sand-beige)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($journey ?? null)
                    <div class="bg-[var(--color-off-white)] p-6 rounded-lg border-l-4 border-[var(--color-accent-gold)] shadow-sm">
                        <p class="text-xs uppercase tracking-wide text-[var(--color-forest-green)] font-semibold mb-2">Enquiring About</p>
                        <h2 class="text-2xl font-serif font-bold text-[var(--color-forest-green)] mb-3">{{ $journey->title }}</h2>
                        <p class="text-[var(--color-earth-brown)] leading-relaxed">{{ Str::limit(strip_tags($journey->narrative_intro), 150) }}</p>
                    </div>
                @endif
                
                @if($country ?? null)
                    <div class="bg-[var(--color-off-white)] p-6 rounded-lg border-l-4 border-[var(--color-accent-gold)] shadow-sm">
                        <p class="text-xs uppercase tracking-wide text-[var(--color-forest-green)] font-semibold mb-2">Interested In</p>
                        <h2 class="text-2xl font-serif font-bold text-[var(--color-forest-green)] mb-3">{{ $country->name }}</h2>
                        <p class="text-[var(--color-earth-brown)] leading-relaxed">{{ Str::limit(strip_tags($country->country_narrative), 150) }}</p>
                    </div>
                @endif
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
                                $companyEmail = \App\Models\SiteSetting::get('company_email');
                                $companyPhone = \App\Models\SiteSetting::get('company_phone');
                                $companyAddress = \App\Models\SiteSetting::get('company_address');
                                $companyCity = \App\Models\SiteSetting::get('company_city');
                                $companyCountry = \App\Models\SiteSetting::get('company_country');
                            @endphp
                            
                            @if($companyEmail)
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-[var(--color-accent-gold)] mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-[var(--color-forest-green)] uppercase tracking-wide mb-1">Email</p>
                                    <a href="mailto:{{ $companyEmail }}" class="text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)] transition-colors break-all">
                                        {{ $companyEmail }}
                                    </a>
                                </div>
                            </div>
                            @endif

                            @if($companyPhone)
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-[var(--color-accent-gold)] mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-[var(--color-forest-green)] uppercase tracking-wide mb-1">Phone</p>
                                    <a href="tel:{{ $companyPhone }}" class="text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)] transition-colors">
                                        {{ $companyPhone }}
                                    </a>
                                </div>
                            </div>
                            @endif

                            @if($companyAddress || $companyCity || $companyCountry)
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-[var(--color-accent-gold)] mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-[var(--color-forest-green)] uppercase tracking-wide mb-1">Address</p>
                                    <p class="text-[var(--color-earth-brown)] leading-relaxed">
                                        @if($companyAddress){{ $companyAddress }}<br>@endif
                                        @if($companyCity){{ $companyCity }}@endif@if($companyCity && $companyCountry), @endif{{ $companyCountry }}
                                    </p>
                                </div>
                            </div>
                            @endif

                            <div class="pt-6 border-t border-[var(--color-sand-beige)]">
                                <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">
                                    We'll work with you to craft a journey that creates lasting memories while supporting conservation and community initiatives across Africa.
                                </p>
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
                        
                        <form method="POST" action="#" class="space-y-6" id="contact-form">
                            @csrf
                            
                            <!-- Honeypot field for spam protection -->
                            <div class="hidden" aria-hidden="true">
                                <label for="website">Website</label>
                                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                            </div>
                            
                            <!-- Inquiry Type -->
                            <div>
                                <label for="inquiry_type" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">I'm interested in</label>
                                <select id="inquiry_type" name="inquiry_type" required class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] bg-white">
                                    <option value="journey" {{ request('inquiry_type') == 'journey' ? 'selected' : '' }}>Designing a Journey</option>
                                    <option value="advisor" {{ request('inquiry_type') == 'advisor' ? 'selected' : '' }}>Travel Advisor Partnership</option>
                                    <option value="partnership" {{ request('inquiry_type') == 'partnership' ? 'selected' : '' }}>Strategic Partnership</option>
                                    <option value="conservation" {{ request('inquiry_type') == 'conservation' ? 'selected' : '' }}>Conservation Partnership</option>
                                    <option value="speaking" {{ request('inquiry_type') == 'speaking' ? 'selected' : '' }}>Speaking Engagement</option>
                                    <option value="media" {{ request('inquiry_type') == 'media' ? 'selected' : '' }}>Media Inquiry</option>
                                    <option value="general" {{ !request('inquiry_type') ? 'selected' : '' }}>General Inquiry</option>
                                </select>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">Name <span class="text-red-600" aria-label="required">*</span></label>
                                    <input type="text" id="name" name="name" required aria-required="true" autocomplete="name" class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] bg-white">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">Email <span class="text-red-600" aria-label="required">*</span></label>
                                    <input type="email" id="email" name="email" required aria-required="true" autocomplete="email" class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] bg-white">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">Phone</label>
                                    <input type="tel" id="phone" name="phone" autocomplete="tel" class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] bg-white">
                                </div>
                                <div>
                                    <label for="country" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">Country of Residence</label>
                                    <input type="text" id="country" name="country" autocomplete="country-name" class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] bg-white">
                                </div>
                            </div>
                            
                            @if($journey ?? null)
                                <div class="bg-[var(--color-off-white)] p-4 rounded-lg border-l-4 border-[var(--color-accent-gold)]">
                                    <input type="hidden" name="journey_id" value="{{ $journey->id }}">
                                    <p class="text-sm text-[var(--color-earth-brown)]">
                                        <strong>Enquiring about:</strong> {{ $journey->title }}
                                    </p>
                                </div>
                            @endif
                            
                            @if($country ?? null)
                                <div class="bg-[var(--color-off-white)] p-4 rounded-lg border-l-4 border-[var(--color-accent-gold)]">
                                    <input type="hidden" name="country_id" value="{{ $country->id }}">
                                    <p class="text-sm text-[var(--color-earth-brown)]">
                                        <strong>Interested in:</strong> {{ $country->name }}
                                    </p>
                                </div>
                            @endif
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">Message <span class="text-red-600" aria-label="required">*</span></label>
                                <textarea id="message" name="message" rows="6" required aria-required="true" class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] bg-white" placeholder="Tell us about your interests, travel dates, or partnership ideas..."></textarea>
                            </div>
                            
                            <div>
                                <button type="submit" class="inline-block px-8 py-4 bg-[var(--color-forest-green)] text-white font-semibold uppercase tracking-wide hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:ring-offset-2 transition-colors">
                                    Send Message
                                </button>
                            </div>
                            
                            <p class="text-xs text-[var(--color-earth-brown)]">
                                * Required fields. We'll respond within 24-48 hours.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
