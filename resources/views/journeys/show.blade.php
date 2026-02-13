@extends('layouts.app')

@section('title', $journey->title . ' - Halisi Africa Discoveries')
@section('description', Str::limit($journey->narrative_intro, 160))

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($journey->hero_image)
            <img src="{{ $journey->hero_image }}" alt="{{ $journey->title }}" class="w-full h-96 object-cover rounded-lg mb-8">
        @endif
        
        <h1 class="text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">{{ $journey->title }}</h1>
        
        <div class="prose prose-lg max-w-none mb-8">
            <p class="text-lg text-[var(--color-earth-brown)] leading-relaxed">{{ $journey->narrative_intro }}</p>
        </div>

        @if($journey->experience_highlights)
            <div class="mb-8">
                <h2 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">Experience Highlights</h2>
                <div class="prose max-w-none">
                    {!! nl2br(e($journey->experience_highlights)) !!}
                </div>
            </div>
        @endif

        @if($journey->regenerative_impact)
            <div class="mb-8">
                <h2 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">Regenerative Impact</h2>
                <div class="prose max-w-none">
                    {!! nl2br(e($journey->regenerative_impact)) !!}
                </div>
            </div>
        @endif

        @if($journey->cta_link && $journey->cta_label)
            <x-button-primary href="{{ $journey->cta_link }}">
                {{ $journey->cta_label }}
            </x-button-primary>
        @endif
    </div>
@endsection
