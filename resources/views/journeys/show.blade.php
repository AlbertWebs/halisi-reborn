@extends('layouts.app')

@php
    $relatedJourneys = \App\Models\Journey::where('is_published', true)
        ->where('id', '!=', $journey->id)
        ->where(function($query) use ($journey) {
            // Same category
            $query->where('journey_category', $journey->journey_category)
                // Or same country
                ->orWhereHas('countries', function($q) use ($journey) {
                    $q->whereIn('countries.id', $journey->countries->pluck('id'));
                });
        })
        ->limit(3)
        ->get();
@endphp

@section('title', $journey->title . ' - Halisi Africa Discoveries')
@section('description', Str::limit($journey->narrative_intro, 160))
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

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[80vh] flex items-end bg-[var(--color-forest-green)] text-white">
        @if($journey->hero_image)
            <div class="absolute inset-0">
                <img src="{{ $journey->hero_image }}" alt="{{ $journey->title }}" loading="eager" fetchpriority="high" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)]">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            </div>
        @endif
        
        <div class="relative z-20 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="max-w-4xl">
                @if($journey->countries->count() > 0)
                    <div class="mb-4">
                        <span class="text-sm uppercase tracking-wide text-[var(--color-accent-gold)] font-semibold">
                            {{ $journey->countries->pluck('name')->join(', ') }}
                        </span>
                    </div>
                @endif
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                    {{ $journey->title }}
                </h1>
            </div>
        </div>
    </section>

    <!-- Narrative Introduction -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                <p class="text-xl leading-relaxed">
                    {{ $journey->narrative_intro }}
                </p>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Experience Highlights -->
    @if($journey->experience_highlights)
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8">
                Experience Highlights
            </h2>
            <div class="bg-white p-8 rounded-lg">
                <div class="prose max-w-none text-[var(--color-earth-brown)]">
                    {!! nl2br(e($journey->experience_highlights)) !!}
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />
    @endif

    <!-- Regenerative Impact -->
    @if($journey->regenerative_impact)
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Regenerative Impact
                </h2>
            </div>
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] mb-8">
                {!! nl2br(e($journey->regenerative_impact)) !!}
            </div>
            
            @if($journey->countries->count() > 0)
                @foreach($journey->countries as $country)
                    @if($country->conservation_focus)
                        <div class="bg-[var(--color-off-white)] p-6 rounded-lg mt-8">
                            <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                                Conservation Focus in {{ $country->name }}
                            </h3>
                            <p class="text-[var(--color-earth-brown)] leading-relaxed">
                                {{ Str::limit($country->conservation_focus, 300) }}
                            </p>
                            <a href="{{ route('countries.show', $country) }}" class="inline-block mt-4 text-[var(--color-forest-green)] font-medium hover:text-[var(--color-accent-gold)] transition-colors">
                                Learn more about {{ $country->name }} →
                            </a>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </section>

    <x-section-divider />
    @endif

    <!-- Country Context Block -->
    @if($journey->countries->count() > 0)
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8 text-center">
                Explore {{ $journey->countries->count() > 1 ? 'These Countries' : 'This Country' }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-{{ min($journey->countries->count(), 3) }} gap-8">
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

    <x-section-divider />
    @endif

    <!-- Related Journeys -->
    @if($relatedJourneys->count() > 0)
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8 text-center">
                Related Journeys
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedJourneys as $related)
                    <x-journey-card :journey="$related" />
                @endforeach
            </div>
        </div>
    </section>

    <x-section-divider />
    @endif

    <!-- Enquiry CTA -->
    <section class="section-padding bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">
                Enquire About This Journey
            </h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Let us design a bespoke experience based on this journey, tailored to your interests and travel style.
            </p>
            <x-button-primary href="{{ route('contact.index', ['journey' => $journey->slug]) }}" class="bg-white text-[var(--color-forest-green)] hover:bg-gray-100 text-lg px-10 py-5 border-0">
                Enquire Now
            </x-button-primary>
        </div>
    </section>
@endsection
