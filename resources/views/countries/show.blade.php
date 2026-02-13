@extends('layouts.app')

@section('title', $country->name . ' - Halisi Africa Discoveries')
@section('description', Str::limit($country->country_narrative, 160))

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($country->hero_image)
            <img src="{{ $country->hero_image }}" alt="{{ $country->name }}" class="w-full h-96 object-cover rounded-lg mb-8">
        @endif
        
        <h1 class="text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">{{ $country->name }}</h1>
        
        <div class="prose prose-lg max-w-none mb-8">
            <p class="text-lg text-[var(--color-earth-brown)] leading-relaxed">{{ $country->country_narrative }}</p>
        </div>

        @if($country->signature_experiences)
            <div class="mb-8">
                <h2 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">Signature Experiences</h2>
                <div class="prose max-w-none">
                    {!! nl2br(e($country->signature_experiences)) !!}
                </div>
            </div>
        @endif

        @if($country->conservation_focus)
            <div class="mb-8">
                <h2 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">Conservation Focus</h2>
                <div class="prose max-w-none">
                    {!! nl2br(e($country->conservation_focus)) !!}
                </div>
            </div>
        @endif

        @if($country->cta_link && $country->cta_label)
            <x-button-primary href="{{ $country->cta_link }}">
                {{ $country->cta_label }}
            </x-button-primary>
        @endif
    </div>
@endsection
