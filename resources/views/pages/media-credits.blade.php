@extends('layouts.app')

@section('title', $page?->meta_title ?: 'Media Credits - Halisi Africa Discoveries')
@section('description', $page?->meta_description ?: 'Media and asset credits for Halisi Africa Discoveries website.')

@section('content')
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h1 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    {{ $page?->hero_title ?: 'Media Credits' }}
                </h1>
                <p class="text-[var(--color-earth-brown)]">
                    {{ $page?->hero_subtext ?: 'We acknowledge the photographers, filmmakers, partners, and communities who make this storytelling possible.' }}
                </p>
            </div>

            @if(filled($page?->body_content))
                <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] js-scroll js-scroll-fade">
                    {!! $page->body_content !!}
                </div>
            @else
                <div class="space-y-8 text-[var(--color-earth-brown)] js-scroll-stagger">
                    <div>
                        <h2 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">Photography</h2>
                        <p>Photography used across the website is credited to Halisi Africa contributors and partner creators.</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">Video</h2>
                        <p>Video media and reels are used with permission from creators, collaborators, and destination partners.</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">Brand & Visual Assets</h2>
                        <p>Brand illustrations, icons, and supporting graphics are either original assets or properly licensed resources.</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">Credit Corrections</h2>
                        <p>
                            If any credit is missing or inaccurate, please contact us and we will update this page promptly.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
