@extends('layouts.app')

@section('title', $country->name . ' - Halisi Africa Discoveries')
@section('description', Str::limit($country->country_narrative, 160))
@push('structured_data')
<x-structured-data 
    type="breadcrumb" 
    :data="[
        'items' => [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Countries', 'url' => route('countries.index')],
            ['name' => $country->name, 'url' => route('countries.show', $country)],
        ]
    ]"
/>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[80vh] flex items-end bg-[var(--color-forest-green)] text-white">
        @if($country->hero_image)
            <div class="absolute inset-0">
                <img src="{{ $country->hero_image }}" alt="{{ $country->name }}" loading="eager" fetchpriority="high" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)]">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            </div>
        @endif
        
        <div class="relative z-20 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="max-w-4xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                    {{ $country->name }}
                </h1>
                <div class="prose prose-lg max-w-none text-gray-100">
                    <p class="text-xl leading-relaxed">
                        {{ Str::limit($country->country_narrative, 200) }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Narrative Introduction -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                <p class="text-xl leading-relaxed">
                    {{ $country->country_narrative }}
                </p>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Signature Experiences -->
    @if($country->signature_experiences)
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8">
                Signature Experiences
            </h2>
            <div class="bg-white p-8 rounded-lg">
                <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                    {!! nl2br(e($country->signature_experiences)) !!}
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />
    @endif

    <!-- Conservation & Community Focus -->
    @if($country->conservation_focus)
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Conservation & Community Focus
                </h2>
            </div>
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                {!! nl2br(e($country->conservation_focus)) !!}
            </div>
            
            <div class="mt-8">
                <x-button-secondary href="{{ route('impact.responsible-travel') }}">
                    Learn About Our Impact Approach
                </x-button-secondary>
            </div>
        </div>
    </section>

    <x-section-divider />
    @endif

    <!-- Featured Journeys -->
    @if($journeys->count() > 0)
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8 text-center">
                Featured Journeys in {{ $country->name }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($journeys as $journey)
                    <x-journey-card :journey="$journey" />
                @endforeach
            </div>
            
            <div class="mt-12 text-center">
                <x-button-primary href="{{ route('journeys.index') }}">
                    View All Journeys
                </x-button-primary>
            </div>
        </div>
    </section>

    <x-section-divider />
    @endif

    <!-- CTA Block -->
    <section class="section-padding bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">
                Explore {{ $country->name }} Journeys
            </h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Let us design a bespoke journey in {{ $country->name }} tailored to your interests and travel style.
            </p>
            <x-button-primary href="{{ route('contact.index', ['country' => $country->slug]) }}" class="bg-white text-[var(--color-forest-green)] hover:bg-gray-100 text-lg px-10 py-5 border-0">
                Design Your Journey
            </x-button-primary>
        </div>
    </section>
@endsection
