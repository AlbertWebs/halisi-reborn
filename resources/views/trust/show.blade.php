@php
    $titlePlain = html_entity_decode($post->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $categoryPlain = html_entity_decode((string) $post->category, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $featuredUrl = $post->resolvedFeaturedImageUrl();
    $metaDescription = $post->plainSummaryForMeta();
    $ogImage = $featuredUrl ?: url('/og-image.jpg');
@endphp
@extends('layouts.app')

@section('title', $titlePlain . ' - Halisi Trust')
@section('description', $metaDescription)

@if($featuredUrl)
    @push('og_image')
        {{ $featuredUrl }}
    @endpush
@endif

@push('structured_data')
<x-structured-data
    type="article"
    :data="[
        'title' => $titlePlain,
        'description' => $metaDescription,
        'image' => $ogImage,
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
            ['name' => $titlePlain, 'url' => route('trust.show', $post)],
        ],
    ]"
/>
@endpush

@section('content')
    @if($featuredUrl)
        <section class="relative min-h-[42vh] md:min-h-[52vh] max-h-[min(72vh,680px)] overflow-hidden bg-[var(--color-forest-green)]">
            <img
                src="{{ $featuredUrl }}"
                alt=""
                loading="eager"
                fetchpriority="high"
                class="absolute inset-0 w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/45 to-black/25" aria-hidden="true"></div>
            <div class="relative z-10 flex min-h-[42vh] md:min-h-[52vh] max-h-[min(72vh,680px)] flex-col justify-end">
                <div class="max-w-3xl mx-auto w-full px-4 sm:px-6 lg:px-8 pb-10 md:pb-14">
                    <nav class="mb-5 text-sm text-white/85 js-scroll" aria-label="Breadcrumb">
                        <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 list-none p-0 m-0">
                            <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                            <li class="text-white/50" aria-hidden="true">/</li>
                            <li><a href="{{ route('trust.index') }}" class="hover:text-white transition-colors">Halisi Trust</a></li>
                            <li class="text-white/50" aria-hidden="true">/</li>
                            <li class="text-white/95 font-medium truncate max-w-[min(100%,12rem)] sm:max-w-none" aria-current="page">{{ Str::limit($titlePlain, 48) }}</li>
                        </ol>
                    </nav>
                    <p class="text-xs uppercase tracking-[0.2em] text-[var(--color-accent-gold)] font-semibold mb-3 js-scroll">{{ $categoryPlain }}</p>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-serif font-bold text-white text-balance leading-tight js-scroll">
                        {{ $titlePlain }}
                    </h1>
                </div>
            </div>
        </section>
    @else
        <section class="bg-gradient-to-br from-[var(--color-forest-green)] to-[#133629] text-white section-padding">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="mb-6 text-sm text-white/80 js-scroll" aria-label="Breadcrumb">
                    <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 list-none p-0 m-0">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li class="text-white/45" aria-hidden="true">/</li>
                        <li><a href="{{ route('trust.index') }}" class="hover:text-white transition-colors">Halisi Trust</a></li>
                    </ol>
                </nav>
                <a href="{{ route('trust.index') }}" class="inline-flex items-center gap-2 text-sm text-white/85 hover:text-white mb-6 js-scroll transition-colors">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to articles
                </a>
                <p class="text-xs uppercase tracking-[0.2em] text-[var(--color-accent-gold)] font-semibold mb-3 js-scroll">{{ $categoryPlain }}</p>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-serif font-bold text-white text-balance leading-tight js-scroll">
                    {{ $titlePlain }}
                </h1>
            </div>
        </section>
    @endif

    <article class="bg-[var(--color-off-white)]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 md:pt-14 pb-12 md:pb-16">
            @if($featuredUrl)
                <a href="{{ route('trust.index') }}" class="inline-flex items-center gap-2 text-sm text-[var(--color-forest-green)] hover:text-[var(--color-accent-gold)] mb-8 js-scroll transition-colors font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to articles
                </a>
            @endif

            <div class="flex flex-wrap items-center gap-3 gap-y-2 mb-8 js-scroll">
                @if(filled($post->category))
                    <span class="inline-flex items-center rounded-full border border-[var(--color-sand-beige)] bg-white px-3 py-1 text-xs font-semibold uppercase tracking-wide text-[var(--color-forest-green)]">
                        {{ $categoryPlain }}
                    </span>
                @endif
                @if($post->published_at)
                    <time class="text-sm text-[var(--color-earth-brown)]" datetime="{{ $post->published_at->toIso8601String() }}">
                        {{ $post->published_at->format('F j, Y') }}
                    </time>
                @endif
                <span class="text-sm text-[var(--color-earth-brown)]/80">{{ $post->estimatedMinutesToRead() }} min read</span>
            </div>

            @if($excerptLead = $post->displayExcerptPlain())
                <p class="text-lg md:text-xl text-[var(--color-earth-brown)] leading-relaxed border-l-4 border-[var(--color-accent-gold)] pl-5 md:pl-6 py-1 mb-10 md:mb-12 bg-white/60 rounded-r-lg js-scroll">
                    {{ $excerptLead }}
                </p>
            @endif

            <div class="trust-article-body bg-white rounded-2xl border border-[var(--color-sand-beige)]/80 shadow-sm px-5 py-8 sm:px-8 sm:py-10 md:px-10 md:py-12 js-scroll js-scroll-fade">
                {!! $post->htmlBody() !!}
            </div>
        </div>
    </article>

    <x-section-divider />

    @if($relatedPosts->count() > 0)
        <section class="section-padding bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-2 js-scroll">
                    Related articles
                </h2>
                <p class="text-sm text-[var(--color-earth-brown)] mb-8 md:mb-10 max-w-xl js-scroll">More from the same thread of ideas and field notes.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 js-scroll-stagger">
                    @foreach($relatedPosts as $related)
                        @php
                            $relTitle = html_entity_decode($related->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                            $relCat = html_entity_decode((string) $related->category, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                            $relImg = $related->resolvedFeaturedImageUrl();
                            $relExcerpt = $related->displayExcerptPlain(140);
                        @endphp
                        <article class="group flex flex-col h-full rounded-xl border border-[var(--color-sand-beige)] bg-[var(--color-off-white)] overflow-hidden hover:border-[var(--color-forest-green)]/25 hover:shadow-md transition-all duration-300">
                            <a href="{{ route('trust.show', $related) }}" class="flex flex-col h-full focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-nav-active)] focus-visible:ring-offset-2 rounded-xl">
                                @if($relImg)
                                    <div class="aspect-[16/10] bg-[var(--color-sand-beige)] overflow-hidden">
                                        <img
                                            src="{{ $relImg }}"
                                            alt=""
                                            loading="lazy"
                                            width="480"
                                            height="300"
                                            class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500"
                                        >
                                    </div>
                                @else
                                    <div class="aspect-[16/10] bg-gradient-to-br from-[var(--color-sand-beige)] to-[var(--color-earth-brown)]/30" aria-hidden="true"></div>
                                @endif
                                <div class="p-5 flex flex-col flex-1">
                                    <span class="text-xs uppercase tracking-wide text-[var(--color-accent-gold)] font-semibold mb-2">{{ $relCat }}</span>
                                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-2 group-hover:text-[var(--color-accent-gold)] transition-colors text-balance">
                                        {{ $relTitle }}
                                    </h3>
                                    @if($relExcerpt)
                                        <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed line-clamp-2 mt-auto">
                                            {{ $relExcerpt }}
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

    <section class="section-padding bg-[var(--color-forest-green)] text-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-serif font-bold mb-4 js-scroll">
                Turn reading into a journey
            </h2>
            <p class="text-base md:text-lg text-white/85 mb-8 max-w-xl mx-auto leading-relaxed js-scroll">
                Explore trips that align with the places and principles you care about.
            </p>
            <div class="js-scroll">
                <x-button-primary href="{{ route('journeys.index') }}" title="Explore curated journeys across Africa" class="!bg-white !text-[var(--color-forest-green)] hover:!bg-gray-100 !border-[var(--color-forest-green)]/25 text-base px-8 py-4">
                    Explore journeys
                </x-button-primary>
            </div>
        </div>
    </section>
@endsection
