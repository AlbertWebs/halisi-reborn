@extends('layouts.app')

@php
    $relatedJourneys = \App\Models\Journey::where('is_published', true)
        ->where('id', '!=', $journey->id)
        ->where(function($query) use ($journey) {
            $query->where('journey_category', $journey->journey_category)
                ->orWhereHas('countries', function($q) use ($journey) {
                    $q->whereIn('countries.id', $journey->countries->pluck('id'));
                });
        })
        ->limit(3)
        ->get();
    $waPhone = preg_replace('/\D/', '', \App\Models\SiteSetting::get('company_phone', '254700000000')) ?: '254700000000';
@endphp

@php
    $heroVideoId = null;
    if (filled($journey->hero_video)) {
        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $journey->hero_video, $m)) {
            $heroVideoId = $m[1];
        } elseif (preg_match('/\/(\d+)(?:\?|$)/', $journey->hero_video, $m)) {
            $heroVideoId = $m[1];
        } elseif (preg_match('/^\d+$/', trim($journey->hero_video))) {
            $heroVideoId = trim($journey->hero_video);
        }
    }
    $heroImageUrl = $journey->hero_image
        ? (str_starts_with($journey->hero_image, 'http') ? $journey->hero_image : asset('storage/' . $journey->hero_image))
        : null;
@endphp
@section('title', $journey->title . ' - Halisi Africa Discoveries')
@section('description', Str::limit(strip_tags($journey->narrative_intro), 160))
@push('structured_data')
<x-structured-data 
    type="breadcrumb" 
    :data="[
        'items' => [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Journeys', 'url' => route('journeys.index')],
            ['name' => $journey->title, 'url' => route('journeys.show', $journey)],
        ]
    ]"
/>
@endpush

@push('styles')
<style>
    .journey-hero-title { text-shadow: 0 2px 24px rgba(0,0,0,0.35); }
    .journey-section-label { letter-spacing: 0.2em; }
    .journey-prose p:first-child { margin-top: 0; }
    .journey-card { box-shadow: 0 4px 24px rgba(26, 77, 58, 0.08); }
    .journey-book-modal-backdrop { background: rgba(26, 77, 58, 0.6); backdrop-filter: blur(6px); }
    .journey-book-modal { animation: journeyModalIn 0.3s ease-out; }
    @keyframes journeyModalIn { from { opacity: 0; transform: scale(0.96) translateY(-10px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    .journey-sticky-book { box-shadow: 0 4px 20px rgba(26, 77, 58, 0.25); }
    html { scroll-behavior: smooth; }
    .journey-hero-scroll-hint { animation: journeyScrollBounce 2.5s ease-in-out infinite; }
    @keyframes journeyScrollBounce { 0%, 100% { transform: translateY(0); opacity: 0.9; } 50% { transform: translateY(6px); opacity: 0.6; } }
    .journey-gallery-thumb img { transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1); }
    .journey-gallery-thumb:hover img { transform: scale(1.04); }
    .itinerary-day:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(26, 77, 58, 0.12); }
    .journey-cta-section { background: linear-gradient(180deg, var(--color-off-white) 0%, rgba(255,250,245,0.6) 100%); }
    #journey-gallery-lightbox img { animation: journeyLightboxIn 0.25s ease-out; }
    @keyframes journeyLightboxIn { from { opacity: 0; transform: scale(0.98); } to { opacity: 1; transform: scale(1); } }
    /* Sticky book button above mobile nav; safe area for notched devices */
    #journey-sticky-book {
        z-index: 50;
        bottom: 5rem; /* above mobile bottom nav */
        left: max(1rem, env(safe-area-inset-left, 1rem));
    }
    @media (min-width: 768px) {
        #journey-sticky-book { bottom: 1.5rem; left: 1.5rem; }
    }
</style>
@endpush

@section('content')
    <!-- Hero -->
    <section class="journey-hero relative min-h-[85vh] flex items-end bg-[var(--color-forest-green)] text-white overflow-hidden">
        @if($heroVideoId)
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 overflow-hidden">
                    <iframe
                        src="https://player.vimeo.com/video/{{ $heroVideoId }}?background=1&autoplay=1&loop=1&muted=1&controls=0&playsinline=1&byline=0&title=0"
                        frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen
                        class="absolute top-1/2 left-1/2 w-[177.78vh] min-w-full h-full min-h-[56.25vw] -translate-x-1/2 -translate-y-1/2 pointer-events-none"
                        style="border: 0;"
                    ></iframe>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/50 to-black/30 z-10"></div>
            </div>
        @elseif($heroImageUrl)
            <div class="absolute inset-0 z-0">
                <img src="{{ $heroImageUrl }}" alt="{{ $journey->title }}" loading="eager" fetchpriority="high" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/50 to-black/30 z-10"></div>
            </div>
        @else
            <div class="absolute inset-0 z-0 bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)]">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
            </div>
        @endif

        <div class="relative z-20 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20 pt-12">
            <div class="max-w-3xl">
                @if($journey->countries->count() > 0)
                    <p class="journey-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-5">
                        {{ $journey->countries->pluck('name')->join(' · ') }}
                    </p>
                @endif
                <h1 class="journey-hero-title text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-serif font-bold text-balance leading-tight">
                    {{ $journey->title }}
                </h1>
            </div>
            <a href="#journey-content-start" class="absolute bottom-4 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 hidden sm:flex text-white/80 hover:text-white transition-colors cursor-pointer no-underline focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent rounded py-1" aria-label="Scroll to content">
                <span class="journey-hero-scroll-hint text-xs uppercase tracking-widest font-medium">Scroll to explore</span>
                <svg class="journey-hero-scroll-hint w-5 h-5 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
            </a>
        </div>
    </section>

    <!-- Narrative -->
    <section id="journey-content-start" class="py-16 md:py-24 bg-white scroll-mt-4">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="mb-8" aria-label="Breadcrumb">
                <a href="{{ route('journeys.index') }}" class="inline-flex items-center gap-2 text-sm text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    All journeys
                </a>
            </nav>
            <p class="journey-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-6">About this journey</p>
            <div class="js-scroll js-scroll-fade border-l-4 border-[var(--color-accent-gold)] pl-8 md:pl-10">
                <div class="journey-prose prose prose-lg max-w-none text-[var(--color-earth-brown)] prose-headings:text-[var(--color-forest-green)]">
                    <div class="text-lg md:text-xl leading-relaxed">
                        {!! $journey->narrative_intro !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sample Itinerary -->
    @if($journey->itineraryItems->count() > 0)
    <section class="py-16 md:py-24 bg-[var(--color-off-white)]" aria-labelledby="itinerary-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll mb-10 md:mb-12">
                <p class="journey-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3 text-center">Itinerary</p>
                <h2 id="itinerary-heading" class="text-2xl md:text-3xl font-serif font-bold text-[var(--color-forest-green)] text-center">
                    Sample Itinerary
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8 js-scroll-stagger">
                @foreach($journey->itineraryItems as $item)
                    <article class="itinerary-day relative flex flex-col bg-white rounded-xl p-5 sm:p-6 md:p-8 shadow-sm border border-[var(--color-sand-beige)]/30 hover:border-[var(--color-sand-beige)]/60 transition-all duration-300">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="w-12 h-12 sm:w-14 sm:h-14 flex-shrink-0 rounded-full bg-[var(--color-forest-green)] text-white flex items-center justify-center font-serif font-bold text-base sm:text-lg shadow-md" aria-hidden="true">
                                {{ $item->day }}
                            </span>
                            <h3 class="text-lg sm:text-xl font-serif font-semibold text-[var(--color-forest-green)] leading-tight min-w-0">
                                {{ $item->title }}
                            </h3>
                        </div>
                        @if($item->content)
                            <div class="prose prose-sm sm:prose-base max-w-none text-[var(--color-earth-brown)] leading-relaxed prose-p:my-2 first:prose-p:mt-0 last:prose-p:mb-0 flex-1">
                                {!! $item->content !!}
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
             
        </div>
       
    </section>
    @endif

     <!-- separator -->
     <x-section-divider />

  

    <!-- Gallery -->
    @if($journey->galleryImages->count() > 0)
    <section class="py-16 md:py-24 bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll mb-12">
                <p class="journey-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-4 text-center">Gallery</p>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] text-center">
                    In the wild
                </h2>
            </div>
            <div class="js-scroll grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($journey->galleryImages as $img)
                    @php
                        $imgUrl = str_starts_with($img->image, 'http') ? $img->image : asset('storage/' . $img->image);
                    @endphp
                    <button type="button" class="journey-gallery-thumb block w-full aspect-[4/3] rounded-xl overflow-hidden border border-[var(--color-sand-beige)]/40 bg-white shadow-sm hover:shadow-lg hover:border-[var(--color-sand-beige)]/70 focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:ring-offset-2 transition-all duration-300" data-src="{{ $imgUrl }}" aria-label="View image">
                        <img src="{{ $imgUrl }}" alt="{{ $journey->title }} gallery" class="w-full h-full object-cover" loading="lazy">
                    </button>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Gallery lightbox -->
    <div id="journey-gallery-lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-4" aria-hidden="true" role="dialog" aria-modal="true">
        <button type="button" id="journey-gallery-lightbox-close" class="absolute top-4 right-4 z-10 p-2 text-white/90 hover:text-white rounded-full hover:bg-white/10 transition-colors" aria-label="Close">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img id="journey-gallery-lightbox-img" src="" alt="Gallery" class="max-w-full max-h-full object-contain rounded">
    </div>
    @endif

    <!-- Experience Highlights & Regenerative Impact (side by side, white bg) -->
    @if($journey->experience_highlights || $journey->regenerative_impact)
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-start">
                @if($journey->experience_highlights)
                <div class="flex flex-col">
                    <p class="journey-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3">Experience</p>
                    <div class="w-16 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                    <h2 class="text-2xl md:text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                        Experience Highlights
                    </h2>
                    <div class="bg-[var(--color-off-white)] p-6 md:p-8 rounded-xl border border-[var(--color-sand-beige)]/50 shadow-sm">
                        <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] prose-ul:my-4 prose-li:my-1 prose-li:marker:text-[var(--color-accent-gold)]">
                            {!! $journey->experience_highlights !!}
                        </div>
                    </div>
                </div>
                @endif

                @if($journey->regenerative_impact)
                <div class="flex flex-col">
                    <p class="journey-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3">Impact</p>
                    <div class="w-16 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                    <h2 class="text-2xl md:text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                        Regenerative Impact
                    </h2>
                    <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] mb-8">
                        {!! $journey->regenerative_impact !!}
                    </div>
                    @if($journey->countries->count() > 0)
                        <div class="space-y-6">
                        @foreach($journey->countries as $country)
                            @if($country->conservation_focus)
                                <div class="bg-[var(--color-off-white)] p-6 md:p-8 rounded-xl border border-[var(--color-sand-beige)]/50 shadow-sm">
                                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-3">
                                        Conservation Focus in {{ $country->name }}
                                    </h3>
                                    <p class="text-[var(--color-earth-brown)] leading-relaxed text-sm md:text-base">
                                        {{ Str::limit(strip_tags($country->conservation_focus), 300) }}
                                    </p>
                                    <a href="{{ route('countries.show', $country) }}" class="inline-flex items-center gap-1 mt-4 text-[var(--color-forest-green)] font-medium hover:text-[var(--color-accent-gold)] transition-colors text-sm">
                                        Learn more about {{ $country->name }}
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                        </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- Country Context -->
    @if($journey->countries->count() > 0)
    <section class="py-16 md:py-24 bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll mb-12">
                <p class="journey-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-4 text-center">Explore</p>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] text-center">
                    {{ $journey->countries->count() > 1 ? 'Countries on this journey' : 'Country' }}
                </h2>
            </div>
            <div class="js-scroll grid grid-cols-1 md:grid-cols-{{ min($journey->countries->count(), 3) }} gap-8">
                @foreach($journey->countries->take(3) as $country)
                    <x-country-card 
                        name="{{ $country->name }}" 
                        slug="{{ $country->slug }}"
                        image="{{ $country->hero_image }}"
                        excerpt="{{ Str::limit($country->country_narrative, 100) }}"
                    />
                @endforeach
            </div>
        </div>
    </section>

    
    @endif

    <!-- Related Journeys -->
    @if($relatedJourneys->count() > 0)
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll mb-12">
                <p class="journey-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-4 text-center">More to explore</p>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] text-center">
                    Related Journeys
                </h2>
            </div>
            <div class="js-scroll grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedJourneys as $related)
                    <x-journey-card :journey="$related" />
                @endforeach
            </div>
        </div>
    </section>

    
    @endif

    <!-- Book this safari (CTA + modal) -->
    <section class="journey-cta-section py-20 md:py-28 relative">
        <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
            <div class="absolute top-1/4 left-0 w-64 h-64 rounded-full bg-[var(--color-accent-gold)]/5 -translate-x-1/2"></div>
            <div class="absolute bottom-1/4 right-0 w-96 h-96 rounded-full bg-[var(--color-forest-green)]/5 translate-x-1/3"></div>
        </div>
        <div class="js-scroll relative max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="journey-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-4">Ready to go</p>
            <div class="w-16 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                Book This Safari
            </h2>
            <p class="text-lg text-[var(--color-earth-brown)] mb-10 max-w-xl mx-auto leading-relaxed">
                Share your details and we’ll contact you to confirm your booking and next steps.
            </p>
            <button type="button" id="journey-book-open" class="inline-flex items-center justify-center gap-3 bg-[var(--color-forest-green)] text-white font-semibold uppercase tracking-wide text-base px-10 py-5 rounded-xl hover:bg-[var(--color-forest-green)]/90 focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:ring-offset-2 transition-all duration-300 border-2 border-[var(--color-forest-green)] shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98]">
                <svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Request a callback
            </button>
        </div>
    </section>

    <!-- Booking modal -->
    <div id="journey-book-modal" class="fixed inset-0 z-50 journey-book-modal-backdrop hidden flex items-center justify-center p-4" aria-hidden="true">
        <div class="journey-book-modal bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-y-auto" role="dialog" aria-labelledby="journey-book-title" aria-modal="true">
            <div class="p-8 md:p-10">
                <div class="flex items-center justify-between mb-8">
                    <h3 id="journey-book-title" class="text-2xl font-serif font-bold text-[var(--color-forest-green)]">Request a callback</h3>
                    <button type="button" id="journey-book-close" class="p-2 text-[var(--color-earth-brown)] hover:text-[var(--color-forest-green)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)]" aria-label="Close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <p class="text-[var(--color-earth-brown)] mb-6">We’ll contact you to confirm your booking for <strong>{{ $journey->title }}</strong>.</p>
                <form id="journey-book-form" class="space-y-5">
                    <div>
                        <label for="book-name" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">Name *</label>
                        <input type="text" id="book-name" name="name" required placeholder="Your full name"
                               class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:border-[var(--color-forest-green)] text-[var(--color-earth-brown)] placeholder:text-gray-400">
                    </div>
                    <div>
                        <label for="book-email" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">Email *</label>
                        <input type="email" id="book-email" name="email" required placeholder="you@example.com"
                               class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:border-[var(--color-forest-green)] text-[var(--color-earth-brown)] placeholder:text-gray-400">
                    </div>
                    <div>
                        <label for="book-phone" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">Phone *</label>
                        <input type="tel" id="book-phone" name="phone" required placeholder="For callback"
                               class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:border-[var(--color-forest-green)] text-[var(--color-earth-brown)] placeholder:text-gray-400">
                    </div>
                    <div>
                        <label for="book-dates" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">Preferred dates</label>
                        <input type="text" id="book-dates" name="dates" placeholder="e.g. March 2025"
                               class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:border-[var(--color-forest-green)] text-[var(--color-earth-brown)] placeholder:text-gray-400">
                    </div>
                    <div>
                        <label for="book-message" class="block text-sm font-medium text-[var(--color-forest-green)] mb-2">Message</label>
                        <textarea id="book-message" name="message" rows="3" placeholder="Any special requests or questions"
                                  class="w-full px-4 py-3 border border-[var(--color-sand-beige)] rounded-lg focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:border-[var(--color-forest-green)] text-[var(--color-earth-brown)] placeholder:text-gray-400"></textarea>
                    </div>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] text-white font-semibold py-4 px-6 rounded-lg hover:bg-[#20bd5a] focus:outline-none focus:ring-2 focus:ring-[#25D366] focus:ring-offset-2 transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Send via WhatsApp
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Sticky book button -->
    <div id="journey-sticky-book" class="fixed hidden">
        <button type="button" id="journey-sticky-book-btn" class="journey-sticky-book inline-flex items-center gap-2 bg-[var(--color-forest-green)] text-white font-semibold uppercase tracking-wide text-sm px-5 py-3.5 md:px-6 md:py-4 rounded-full hover:bg-[var(--color-forest-green)]/90 focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-gold)] focus:ring-offset-2 transition-all min-h-[44px]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Book this safari
        </button>
    </div>

    

   

    <script>
        (function() {
            var journeyTitle = @json($journey->title);
            var waPhone = @json($waPhone);
            var modal = document.getElementById('journey-book-modal');
            var form = document.getElementById('journey-book-form');
            var openBtn = document.getElementById('journey-book-open');
            var closeBtn = document.getElementById('journey-book-close');
            var sticky = document.getElementById('journey-sticky-book');
            var stickyBtn = document.getElementById('journey-sticky-book-btn');

            function openModal() {
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    modal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                }
            }
            function closeModal() {
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    modal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                }
            }

            if (openBtn) openBtn.addEventListener('click', openModal);
            if (stickyBtn) stickyBtn.addEventListener('click', openModal);
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) closeModal();
                });
            }
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) closeModal();
            });

            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    var name = document.getElementById('book-name').value.trim();
                    var email = document.getElementById('book-email').value.trim();
                    var phone = document.getElementById('book-phone').value.trim();
                    var dates = document.getElementById('book-dates').value.trim();
                    var message = document.getElementById('book-message').value.trim();
                    var lines = [
                        'Hi, I would like to book the ' + journeyTitle + ' safari.',
                        '',
                        'Name: ' + name,
                        'Email: ' + email,
                        'Phone: ' + phone
                    ];
                    if (dates) lines.push('Preferred dates: ' + dates);
                    if (message) lines.push('Message: ' + message);
                    lines.push('');
                    lines.push('Please contact me to confirm and discuss next steps.');
                    var text = lines.join('\n');
                    var url = 'https://wa.me/' + waPhone + '?text=' + encodeURIComponent(text);
                    window.open(url, '_blank', 'noopener,noreferrer');
                    closeModal();
                });
            }

            var ticking = false;
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        if (sticky) {
                            var hero = document.querySelector('.journey-hero');
                            var heroBottom = hero ? hero.getBoundingClientRect().bottom : 0;
                            if (heroBottom < 0) sticky.classList.remove('hidden');
                            else sticky.classList.add('hidden');
                        }
                        ticking = false;
                    });
                    ticking = true;
                }
            });

            var lightbox = document.getElementById('journey-gallery-lightbox');
            var lightboxImg = document.getElementById('journey-gallery-lightbox-img');
            var lightboxClose = document.getElementById('journey-gallery-lightbox-close');
            if (lightbox && lightboxImg) {
                document.querySelectorAll('.journey-gallery-thumb').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var src = this.getAttribute('data-src');
                        if (src) {
                            lightboxImg.src = src;
                            lightbox.classList.remove('hidden');
                            lightbox.classList.add('flex');
                            lightbox.setAttribute('aria-hidden', 'false');
                            document.body.style.overflow = 'hidden';
                        }
                    });
                });
                function closeLightbox() {
                    lightbox.classList.add('hidden');
                    lightbox.classList.remove('flex');
                    lightbox.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                }
                if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
                lightbox.addEventListener('click', function(e) { if (e.target === lightbox) closeLightbox(); });
                document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && lightbox && !lightbox.classList.contains('hidden')) closeLightbox(); });
            }
        })();
    </script>
@endsection
