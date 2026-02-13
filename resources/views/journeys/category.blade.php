@extends('layouts.app')

@section('title', $category . ' - Halisi Africa Discoveries')
@section('description', 'Explore our ' . strtolower($category) . ' journeys designed to regenerate ecosystems and empower communities.')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-12">{{ $category }}</h1>
        
        @if($journeys->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($journeys as $journey)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($journey->hero_image)
                            <img src="{{ $journey->hero_image }}" alt="{{ $journey->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h2 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">{{ $journey->title }}</h2>
                            <p class="text-sm text-[var(--color-earth-brown)] mb-4">{{ Str::limit($journey->narrative_intro, 150) }}</p>
                            <a href="{{ route('journeys.show', $journey) }}" class="text-[var(--color-forest-green)] font-medium hover:underline">Learn More →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-lg text-[var(--color-earth-brown)]">No journeys in this category yet.</p>
        @endif
    </div>
@endsection
