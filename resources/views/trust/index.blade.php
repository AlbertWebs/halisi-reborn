@extends('layouts.app')

@section('title', 'The Halisi Trust - Thought Leadership Hub')
@section('description', 'Field reflections, climate dialogue, and regenerative thinking from the Halisi Trust—stories of impact, community voices, and conservation insights.')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[70vh] flex items-center justify-center bg-[var(--color-forest-green)] text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60 z-10"></div>
            <div class="w-full h-full bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)]"></div>
        </div>
        
        <div class="relative z-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                The Halisi Trust
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto leading-relaxed">
                Field reflections, climate dialogue, regenerative thinking. Stories of impact, community voices, and conservation insights from across Africa.
            </p>
        </div>
    </section>

    <!-- Featured Article -->
    @if($featuredPost ?? null)
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-4"></div>
                <p class="text-sm uppercase tracking-wide text-[var(--color-forest-green)] font-semibold">Featured Article</p>
            </div>
            
            <a href="{{ route('trust.show', $featuredPost) }}" class="block group">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 bg-[var(--color-off-white)] rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    @if($featuredPost->featured_image)
                        <div class="aspect-video lg:aspect-auto lg:h-full overflow-hidden">
                            <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}" loading="eager" fetchpriority="high" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    @else
                        <div class="aspect-video lg:aspect-auto lg:h-full bg-gradient-to-br from-[var(--color-sand-beige)] to-[var(--color-earth-brown)]"></div>
                    @endif
                    <div class="p-8 lg:p-12 flex flex-col justify-center">
                        <span class="text-xs uppercase tracking-wide text-[var(--color-accent-gold)] font-semibold mb-3">{{ $featuredPost->category }}</span>
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4 group-hover:text-[var(--color-accent-gold)] transition-colors">
                            {{ $featuredPost->title }}
                        </h2>
                        @if($featuredPost->excerpt)
                            <p class="text-lg text-[var(--color-earth-brown)] leading-relaxed mb-6">
                                {{ $featuredPost->excerpt }}
                            </p>
                        @endif
                        @if($featuredPost->published_at)
                            <p class="text-sm text-[var(--color-earth-brown)] mb-4">
                                {{ $featuredPost->published_at->format('F j, Y') }}
                            </p>
                        @endif
                        <span class="text-[var(--color-forest-green)] font-medium inline-flex items-center group-hover:text-[var(--color-accent-gold)] transition-colors">
                            Read Article
                            <svg class="ml-2 w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <x-section-divider />
    @endif

    <!-- Editorial Grid -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    Latest Articles
                </h2>
                <p class="text-lg text-[var(--color-earth-brown)]">
                    Explore field stories, community voices, conservation insights, and regenerative tourism reflections.
                </p>
            </div>
            
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 group">
                            <a href="{{ route('trust.show', $post) }}" class="block">
                                @if($post->featured_image)
                                    <div class="aspect-video bg-[var(--color-sand-beige)] overflow-hidden">
                                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" loading="lazy" width="400" height="300" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                @else
                                    <div class="aspect-video bg-gradient-to-br from-[var(--color-sand-beige)] to-[var(--color-earth-brown)]"></div>
                                @endif
                                <div class="p-6">
                                    <span class="text-xs uppercase tracking-wide text-[var(--color-accent-gold)] font-semibold mb-2 block">{{ $post->category }}</span>
                                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3 group-hover:text-[var(--color-accent-gold)] transition-colors">
                                        {{ $post->title }}
                                    </h3>
                                    @if($post->excerpt)
                                        <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed mb-4 line-clamp-2">
                                            {{ $post->excerpt }}
                                        </p>
                                    @endif
                                    @if($post->published_at)
                                        <p class="text-xs text-gray-500 mb-4">
                                            {{ $post->published_at->format('F j, Y') }}
                                        </p>
                                    @endif
                                    <span class="text-[var(--color-forest-green)] font-medium text-sm inline-flex items-center group-hover:text-[var(--color-accent-gold)] transition-colors">
                                        Read More
                                        <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($posts->hasPages())
                    <div class="flex justify-center">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <p class="text-lg text-[var(--color-earth-brown)] mb-6">
                        Articles are coming soon. Check back for field stories, community voices, and conservation insights.
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
