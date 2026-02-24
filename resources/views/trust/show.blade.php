@extends('layouts.app')

@section('title', $post->title . ' - Halisi Trust')
@section('description', $post->excerpt ?? Str::limit($post->content, 160))
@push('structured_data')
<x-structured-data 
    type="article" 
    :data="[
        'title' => $post->title,
        'description' => $post->excerpt ?? Str::limit($post->content, 160),
        'image' => $post->featured_image ?? url('/og-image.jpg'),
        'published_at' => $post->published_at?->toIso8601String(),
        'updated_at' => $post->updated_at->toIso8601String(),
    ]"
/>
<x-structured-data 
    type="breadcrumb" 
    :data="[
        'items' => [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Halisi Trust', 'url' => route('trust.index')],
            ['name' => $post->title, 'url' => route('trust.show', $post)],
        ]
    ]"
/>
@endpush

@section('content')
    <!-- Hero Image -->
    @if($post->featured_image)
    <section class="relative h-[60vh] bg-[var(--color-forest-green)]">
        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" loading="eager" fetchpriority="high" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
    </section>
    @endif

    <!-- Article Content -->
    <article class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 js-scroll">
                <span class="text-xs uppercase tracking-wide text-[var(--color-accent-gold)] font-semibold">{{ $post->category }}</span>
                @if($post->published_at)
                    <span class="text-sm text-[var(--color-earth-brown)] ml-4">{{ $post->published_at->format('F j, Y') }}</span>
                @endif
            </div>
            
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                {{ $post->title }}
            </h1>
            
            @if($post->excerpt)
                <p class="text-xl text-[var(--color-earth-brown)] mb-8 italic leading-relaxed">
                    {{ $post->excerpt }}
                </p>
            @endif
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] js-scroll js-scroll-fade">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </article>

    <x-section-divider />

    <!-- Related Articles -->
    @if($relatedPosts->count() > 0)
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-8 js-scroll">
                Related Articles
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 js-scroll-stagger">
                @foreach($relatedPosts as $related)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 group">
                        <a href="{{ route('trust.show', $related) }}" class="block">
                            @if($related->featured_image)
                                <div class="aspect-video bg-[var(--color-sand-beige)] overflow-hidden">
                                    <img src="{{ $related->featured_image }}" alt="{{ $related->title }}" loading="lazy" width="400" height="300" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @else
                                <div class="aspect-video bg-gradient-to-br from-[var(--color-sand-beige)] to-[var(--color-earth-brown)]"></div>
                            @endif
                            <div class="p-6">
                                <span class="text-xs uppercase tracking-wide text-[var(--color-accent-gold)] font-semibold mb-2 block">{{ $related->category }}</span>
                                <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3 group-hover:text-[var(--color-accent-gold)] transition-colors">
                                    {{ $related->title }}
                                </h3>
                                @if($related->excerpt)
                                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed line-clamp-2">
                                        {{ $related->excerpt }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <x-section-divider />
    @endif

    <!-- CTA Block -->
    <section class="section-padding bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">
                Experience Regenerative Travel
            </h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Ready to create your own impact story? Design a journey that supports the initiatives you've read about.
            </p>
            <x-button-primary href="{{ route('journeys.index') }}" class="bg-white text-[var(--color-forest-green)] hover:bg-gray-100 text-lg px-10 py-5 border-0">
                Explore Journeys
            </x-button-primary>
        </div>
    </section>
@endsection

