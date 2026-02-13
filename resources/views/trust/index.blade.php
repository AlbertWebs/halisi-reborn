@extends('layouts.app')

@section('title', 'Halisi Trust - Stories of Impact')
@section('description', 'Read stories from the field, community voices, and reflections on regenerative tourism from the Halisi Trust.')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-12">Halisi Trust</h1>
        
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <span class="text-xs uppercase tracking-wide text-[var(--color-accent-gold)] mb-2 block">{{ $post->category }}</span>
                            <h2 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">{{ $post->title }}</h2>
                            @if($post->excerpt)
                                <p class="text-sm text-[var(--color-earth-brown)] mb-4">{{ $post->excerpt }}</p>
                            @endif
                            <a href="{{ route('trust.show', $post) }}" class="text-[var(--color-forest-green)] font-medium hover:underline">Read More →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-lg text-[var(--color-earth-brown)]">No posts available yet.</p>
        @endif
    </div>
@endsection
