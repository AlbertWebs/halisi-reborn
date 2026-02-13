@extends('layouts.app')

@section('title', 'Contact Us - Halisi Africa Discoveries')
@section('description', 'Get in touch with Halisi Africa to design your authentic African journey.')

@section('content')
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-[var(--color-forest-green)] mb-8">Contact Us</h1>
            
            @if($journey ?? null)
                <div class="bg-[var(--color-off-white)] p-6 rounded-lg mb-8 border-l-4 border-[var(--color-accent-gold)]">
                    <p class="text-sm uppercase tracking-wide text-[var(--color-forest-green)] font-semibold mb-2">Enquiring About</p>
                    <h2 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">{{ $journey->title }}</h2>
                    <p class="text-[var(--color-earth-brown)]">{{ Str::limit($journey->narrative_intro, 150) }}</p>
                </div>
            @endif
            
            @if($country ?? null)
                <div class="bg-[var(--color-off-white)] p-6 rounded-lg mb-8 border-l-4 border-[var(--color-accent-gold)]">
                    <p class="text-sm uppercase tracking-wide text-[var(--color-forest-green)] font-semibold mb-2">Interested In</p>
                    <h2 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">{{ $country->name }}</h2>
                    <p class="text-[var(--color-earth-brown)]">{{ Str::limit($country->country_narrative, 150) }}</p>
                </div>
            @endif
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                <p class="text-lg leading-relaxed mb-6">
                    Ready to design your authentic African journey? Get in touch with our team to discuss your interests, 
                    travel style, and how we can create a bespoke experience that aligns with your values.
                </p>
                <p class="text-lg leading-relaxed mb-8">
                    We'll work with you to craft a journey that creates lasting memories while supporting conservation 
                    and community initiatives across Africa.
                </p>
            </div>
            
            <!-- Contact Form -->
            <div class="bg-[var(--color-off-white)] p-8 rounded-lg">
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
                        <select id="inquiry_type" name="inquiry_type" required class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:border-[var(--color-forest-green)] bg-white">
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
                        <div class="bg-white p-4 rounded-lg border-l-4 border-[var(--color-accent-gold)]">
                            <input type="hidden" name="journey_id" value="{{ $journey->id }}">
                            <p class="text-sm text-[var(--color-earth-brown)]">
                                <strong>Enquiring about:</strong> {{ $journey->title }}
                            </p>
                        </div>
                    @endif
                    
                    @if($country ?? null)
                        <div class="bg-white p-4 rounded-lg border-l-4 border-[var(--color-accent-gold)]">
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
                        <x-button-primary type="submit" class="w-full md:w-auto">
                            Send Message
                        </x-button-primary>
                    </div>
                    
                    <p class="text-xs text-[var(--color-earth-brown)]">
                        * Required fields. We'll respond within 24-48 hours.
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection
