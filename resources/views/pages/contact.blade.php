@extends('layouts.app')

@section('title', $page?->meta_title ?: 'Contact Us - Halisi Africa Discoveries')
@section('description', $page?->meta_description ?: 'Get in touch with Halisi Africa to design your authentic African journey.')

@section('content')
    @php
        $resolvePageImage = function (?string $image): ?string {
            if (!filled($image)) {
                return null;
            }
            if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
                return $image;
            }
            if (str_starts_with($image, '/storage/')) {
                return asset(ltrim($image, '/'));
            }
            if (str_starts_with($image, 'storage/')) {
                return asset($image);
            }
            return asset('storage/' . ltrim($image, '/'));
        };

        $contactImage1 = $resolvePageImage($page?->content_image_1);
        $contactImage2 = $resolvePageImage($page?->content_image_2);

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
        $mapEmbedUrl = $page?->contact_map_embed_url ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8171118.189420204!2d37.908293199999996!3d0.15456044999999977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xe145849f15414bf%3A0x437aa8a42154d!2sHalisi%20Africa%20Discoveries!5e0!3m2!1sen!2ske!4v1771327531896!5m2!1sen!2ske';
    @endphp
    <!-- Hero Banner -->
    <section class="relative min-h-[60vh] flex items-center justify-center bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)] text-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent z-0"></div>
        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-6">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif font-bold mb-6 text-balance leading-tight">
                {{ $page?->hero_title ?: "Let's Design Your Journey" }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto leading-relaxed">
                {{ $page?->hero_subtext ?: 'Get in touch with our team to discuss your interests, travel style, and how we can create a bespoke experience that aligns with your values.' }}
            </p>
        </div>
    </section>

    <!-- Journey/Country Context -->
    @if(isset($journey) || isset($country))
    <section class="section-padding bg-white border-b border-[var(--color-sand-beige)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 js-scroll-stagger">

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
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch js-scroll-stagger">

                <!-- Contact Information -->
                <div class="lg:col-span-4 flex">
                    <div class="rounded-2xl overflow-hidden shadow-xl w-full h-full flex flex-col">
                        <div class="relative p-8 bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)] text-white flex-1">
                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.25),transparent_45%)]"></div>
                            <div class="relative z-10">
                                <h2 class="text-2xl md:text-3xl font-serif font-bold mb-3">
                                    {{ $page?->contact_section_title ?: 'Get In Touch' }}
                                </h2>
                                <p class="text-sm md:text-base text-gray-100/95 leading-relaxed mb-6">
                                    {{ $page?->contact_section_intro ?: 'We respond quickly and tailor every conversation to your travel goals, pace, and values.' }}
                                </p>

                                @if($contactImage1)
                                    <div class="mb-6 rounded-xl overflow-hidden border border-white/25">
                                        <img src="{{ $contactImage1 }}" alt="Contact highlight" class="w-full h-44 object-cover" loading="lazy">
                                    </div>
                                @endif

                                <div class="space-y-5">
                                    @if($companyEmail)
                                        <div>
                                            <p class="text-xs uppercase tracking-wider text-white/80 font-semibold">{{ $page?->contact_email_label ?: 'Email' }}</p>
                                            <a href="mailto:{{ $companyEmail }}" class="text-white hover:text-[var(--color-accent-gold)] transition-colors break-all">{{ $companyEmail }}</a>
                                        </div>
                                    @endif
                                    @if($companyPhone)
                                        <div>
                                            <p class="text-xs uppercase tracking-wider text-white/80 font-semibold">{{ $page?->contact_phone_label ?: 'Phone' }}</p>
                                            <a href="tel:{{ $companyPhone }}" class="text-white hover:text-[var(--color-accent-gold)] transition-colors">{{ $companyPhone }}</a>
                                        </div>
                                    @endif
                                    @if($companyAddress || $companyCity || $companyCountry)
                                        <div>
                                            <p class="text-xs uppercase tracking-wider text-white/80 font-semibold">{{ $page?->contact_address_label ?: 'Address' }}</p>
                                            <p class="text-white/95">
                                                @if($companyAddress){{ $companyAddress }}<br>@endif
                                                @if($companyCity){{ $companyCity }}@endif
                                                @if($companyCity && $companyCountry), @endif
                                                {{ $companyCountry }}
                                            </p>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-xs uppercase tracking-wider text-white/80 font-semibold">{{ $page?->contact_hours_label ?: 'Office Hours' }}</p>
                                        <p class="text-white/95">{{ $officeHours }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs uppercase tracking-wider text-white/80 font-semibold mb-2">{{ $page?->contact_social_label ?: 'Follow Us' }}</p>
                                        <div class="flex flex-wrap gap-3">
                                            @if($socialFacebook)
                                                <a href="{{ $socialFacebook }}" target="_blank" rel="noopener" aria-label="Facebook" class="w-10 h-10 bg-white/15 border border-white/30 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                                            @endif
                                            @if($socialInstagram)
                                                <a href="{{ $socialInstagram }}" target="_blank" rel="noopener" aria-label="Instagram" class="w-10 h-10 bg-white/15 border border-white/30 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069z"/></svg></a>
                                            @endif
                                            @if($socialTwitter)
                                                <a href="{{ $socialTwitter }}" target="_blank" rel="noopener" aria-label="Twitter" class="w-10 h-10 bg-white/15 border border-white/30 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                                            @endif
                                            @if($socialLinkedin)
                                                <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn" class="w-10 h-10 bg-white/15 border border-white/30 rounded-full flex items-center justify-center hover:bg-[var(--color-accent-gold)] hover:border-[var(--color-accent-gold)] transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/></svg></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($contactImage2)
                            <div class="bg-white p-3">
                                <div class="rounded-xl overflow-hidden">
                                    <img src="{{ $contactImage2 }}" alt="Contact atmosphere" class="w-full h-32 object-cover" loading="lazy">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-8 flex">
                    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-md border border-[var(--color-sand-beige)] w-full h-full">
                        <h2 class="text-2xl md:text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-3">
                            {{ $page?->contact_form_title ?: 'Send Us a Message' }}
                        </h2>
                        <p class="text-[var(--color-earth-brown)] mb-7">
                            {{ $page?->contact_form_intro ?: "Tell us what kind of journey you're imagining and we'll start shaping it with you." }}
                        </p>

                        @if(session('success_contact'))
                            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                                {{ session('success_contact') }}
                            </div>
                        @endif
                        @if($errors->contactForm->any())
                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                                {{ $errors->contactForm->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                            @csrf
                            <input type="hidden" name="rendered_at" value="{{ time() }}">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-[var(--color-forest-green)] mb-1.5">Name *</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)]">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-[var(--color-forest-green)] mb-1.5">Email *</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)]">
                                </div>
                            </div>

                            @isset($journey)
                                <input type="hidden" name="journey_id" value="{{ $journey->id }}">
                            @endisset

                            @isset($country)
                                <input type="hidden" name="country_id" value="{{ $country->id }}">
                            @endisset

                            <div>
                                <label for="message" class="block text-sm font-medium text-[var(--color-forest-green)] mb-1.5">Message *</label>
                                <textarea id="message" name="message" rows="6" required class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)]">{{ old('message') }}</textarea>
                            </div>

                            <div>
                                <label for="challenge_answer" class="block text-sm font-medium text-[var(--color-forest-green)] mb-1.5">
                                    What is {{ $contactChallengeLeft ?? 0 }} + {{ $contactChallengeRight ?? 0 }}? *
                                </label>
                                <input type="number" id="challenge_answer" name="challenge_answer" min="0" required
                                    class="w-full md:w-56 px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)]">
                            </div>

                            <button type="submit" class="inline-flex items-center px-8 py-3.5 rounded-full bg-[var(--color-forest-green)] text-white font-semibold hover:bg-[var(--color-earth-brown)] transition-colors">
                                {{ $page?->contact_form_button_label ?: 'Send Message' }}
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Map Section -->
<div class="mt-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="bg-white p-4 rounded-2xl shadow-md border border-[var(--color-sand-beige)] js-scroll">
        <iframe
            src="{{ $mapEmbedUrl }}"
            class="w-full h-[420px] rounded-xl border-0"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

    @if(($suggestedJourneys ?? collect())->count() > 0)
    <section class="pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    Suggested Journeys
                </h2>
                <p class="text-[var(--color-earth-brown)] max-w-2xl mx-auto">
                    Explore a few inspiring ideas while our team crafts your bespoke trip.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 js-scroll-stagger">
                @foreach($suggestedJourneys as $suggestedJourney)
                    <x-journey-card :journey="$suggestedJourney" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
