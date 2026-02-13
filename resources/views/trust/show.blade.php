@extends('layouts.app')

@section('title', $post->title . ' - Halisi Trust')
@section('description', $post->excerpt ?? Str::limit($post->content, 160))

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($post->featured_image)
            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-96 object-cover rounded-lg mb-8">
        @endif
        
        <div class="mb-4">
            <span class="text-xs uppercase tracking-wide text-[var(--color-accent-gold)]">{{ $post->category }}</span>
            @if($post->published_at)
                <span class="text-sm text-gray-500 ml-4">{{ $post->published_at->format('F j, Y') }}</span>
            @endif
        </div>
        
        <h1 class="text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">{{ $post->title }}</h1>
        
        @if($post->excerpt)
            <p class="text-xl text-[var(--color-earth-brown)] mb-8 italic">{{ $post->excerpt }}</p>
        @endif
        
        <div class="prose prose-lg max-w-none">
            {!! nl2br(e($post->content)) !!}
        </div>
    </div>
@endsection
