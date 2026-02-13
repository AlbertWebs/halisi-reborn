@extends('layouts.app')

@section('title', 'Page Not Found - Halisi Africa Discoveries')
@section('description', 'The page you are looking for has moved or no longer exists.')

@section('content')
    <section class="min-h-[80vh] flex items-center justify-center bg-[var(--color-off-white)]">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-8">
                <div class="text-6xl md:text-8xl font-serif font-bold text-[var(--color-forest-green)] mb-4">404</div>
                <h1 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    The Journey Has Moved
                </h1>
                <p class="text-lg text-[var(--color-earth-brown)] mb-8 leading-relaxed">
                    The page you're looking for has moved or no longer exists. 
                    Let us guide you back to your African journey.
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <x-button-primary href="{{ route('home') }}">
                    Back to Home
                </x-button-primary>
                <x-button-secondary href="{{ route('journeys.index') }}">
                    Explore Journeys
                </x-button-secondary>
            </div>
            
            <div class="mt-12 pt-8 border-t border-[var(--color-sand-beige)]">
                <p class="text-sm text-[var(--color-earth-brown)] mb-4">Quick Links:</p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <a href="{{ route('about') }}" class="text-[var(--color-forest-green)] hover:text-[var(--color-accent-gold)] transition-colors">About</a>
                    <a href="{{ route('countries.index') }}" class="text-[var(--color-forest-green)] hover:text-[var(--color-accent-gold)] transition-colors">Countries</a>
                    <a href="{{ route('contact.index') }}" class="text-[var(--color-forest-green)] hover:text-[var(--color-accent-gold)] transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </section>
@endsection
