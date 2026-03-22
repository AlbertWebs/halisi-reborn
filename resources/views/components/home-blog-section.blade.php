@props([
    'posts',
])

@php
    /** @var \Illuminate\Support\Collection<int, \App\Models\TrustPost> $posts */
    $resolveImage = function (?string $image): ?string {
        if (!filled($image)) {
            return null;
        }
        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }
        if (str_starts_with($image, '/storage/')) {
            return asset(ltrim($image, '/'));
        }
        if (str_starts_with($image, 'storage/')) {
            return asset($image);
        }
        return asset('storage/' . ltrim($image, '/'));
    };
@endphp

<section class="section-padding bg-white border-t border-[var(--color-sand-beige)]/60" aria-labelledby="home-blog-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-10 md:mb-12 js-scroll">
            <div class="text-center sm:text-left">
                <h2 id="home-blog-heading" class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    Blog
                </h2>
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto sm:mx-0"></div>
                <p class="mt-4 text-sm md:text-base text-[var(--color-earth-brown)] max-w-xl">
                    Field notes, impact stories, and ideas from the Halisi Trust.
                </p>
            </div>
            <div class="flex justify-center sm:justify-end shrink-0">
                <x-button-secondary href="{{ route('trust.index') }}" class="text-sm px-6 py-3 tracking-wide">
                    View all articles
                </x-button-secondary>
            </div>
        </div>

        @if($posts->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 js-scroll-stagger">
                @foreach($posts as $post)
                    <article class="bg-[var(--color-off-white)] rounded-xl border border-[var(--color-sand-beige)]/80 overflow-hidden hover:shadow-md transition-shadow duration-300 group h-full flex flex-col">
                        <a href="{{ route('trust.show', $post) }}" class="flex flex-col h-full focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-nav-active)] focus-visible:ring-offset-2 rounded-xl">
                            @php $postImage = $resolveImage($post->featured_image); @endphp
                            @if($postImage)
                                <div class="aspect-[16/10] bg-[var(--color-sand-beige)] overflow-hidden">
                                    <img
                                        src="{{ $postImage }}"
                                        alt="{{ $post->title }}"
                                        loading="lazy"
                                        width="640"
                                        height="400"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    >
                                </div>
                            @else
                                <div class="aspect-[16/10] bg-gradient-to-br from-[var(--color-sand-beige)] to-[var(--color-earth-brown)]/35" aria-hidden="true"></div>
                            @endif
                            <div class="p-5 md:p-6 flex flex-col flex-1">
                                @if(filled($post->category))
                                    <span class="text-xs uppercase tracking-wide text-[var(--color-accent-gold)] font-semibold mb-2">{{ $post->category }}</span>
                                @endif
                                <h3 class="text-lg md:text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2 group-hover:text-[var(--color-accent-gold)] transition-colors text-balance">
                                    {{ $post->title }}
                                </h3>
                                @if(filled($post->excerpt))
                                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed line-clamp-3 mb-4 flex-1">
                                        {{ $post->excerpt }}
                                    </p>
                                @endif
                                <div class="mt-auto flex items-center justify-between gap-3 pt-2">
                                    @if($post->published_at)
                                        <time class="text-xs text-[var(--color-earth-brown)]/80" datetime="{{ $post->published_at->toIso8601String() }}">
                                            {{ $post->published_at->format('M j, Y') }}
                                        </time>
                                    @else
                                        <span></span>
                                    @endif
                                    <span class="text-[var(--color-forest-green)] font-medium text-sm inline-flex items-center group-hover:text-[var(--color-accent-gold)] transition-colors">
                                        Read
                                        <svg class="ml-1 w-4 h-4 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 md:py-12 rounded-xl bg-[var(--color-off-white)] border border-dashed border-[var(--color-sand-beige)] js-scroll">
                <p class="text-[var(--color-earth-brown)] max-w-md mx-auto mb-6">
                    New articles are on the way. Visit the Trust hub for updates and stories.
                </p>
                <x-button-secondary href="{{ route('trust.index') }}" class="text-sm px-6 py-3 tracking-wide">
                    Open Halisi Trust
                </x-button-secondary>
            </div>
        @endif
    </div>
</section>
