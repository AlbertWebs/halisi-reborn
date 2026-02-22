@extends('layouts.app')

@section('title', $page?->meta_title ?: 'About Halisi Africa - Our Story & Philosophy')
@section('description', $page?->meta_description ?: 'Learn about Halisi Africa Discoveries, our regenerative travel philosophy, and why we create journeys that leave more than footprints.')

@section('content')
    @php
        $resolvePageImage = function (?string $image): ?string {
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

        $aboutHeroImage = $resolvePageImage($page?->hero_image);
        $aboutContentImage1 = $resolvePageImage($page?->content_image_1);
        $aboutContentImage2 = $resolvePageImage($page?->content_image_2);
    @endphp

    <!-- Hero Section -->
    <section class="relative min-h-[60vh] flex items-center justify-center bg-[var(--color-forest-green)] text-white overflow-hidden">
        @if($aboutHeroImage)
            <img src="{{ $aboutHeroImage }}" alt="{{ $page?->hero_title ?: 'About Halisi Africa' }}" class="absolute inset-0 w-full h-full object-cover" loading="eager">
            <div class="absolute inset-0 bg-black/45"></div>
        @endif
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                {{ $page?->hero_title ?: 'About Halisi Africa' }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-2xl mx-auto">
                {{ $page?->hero_subtext ?: 'Crafting regenerative luxury travel experiences across Africa' }}
            </p>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Our Story
                </h2>
            </div>
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                <p class="text-lg leading-relaxed mb-6">
                    Halisi Africa Discoveries was born from a simple yet profound belief: travel should regenerate, not just preserve. 
                    Founded by conservationists and travel experts who witnessed the transformative power of responsible tourism, 
                    we set out to create journeys that honor Africa's wild places while empowering the communities who call them home.
                </p>
                <p class="text-lg leading-relaxed mb-6">
                    Our name, "Halisi," means "authentic" in Swahili—a commitment that guides every journey we design. 
                    We believe that authentic travel experiences emerge when conservation, community, and culture converge, 
                    creating lasting positive impact for both travelers and the destinations they visit.
                </p>
                <p class="text-lg leading-relaxed">
                    Today, we partner with leading conservation organizations, community-led initiatives, and sustainable 
                    accommodations across East and Southern Africa to offer bespoke journeys that leave more than footprints—they leave legacy.
                </p>
            </div>
        </div>
    </section>

    @if($aboutContentImage1)
        <section class="pb-8 bg-white">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-xl overflow-hidden shadow-lg border border-[var(--color-sand-beige)]">
                    <img src="{{ $aboutContentImage1 }}" alt="About Halisi story image" class="w-full h-[220px] sm:h-[300px] md:h-[380px] object-cover" loading="lazy">
                </div>
            </div>
        </section>
    @endif

    <x-section-divider />

    <!-- Our Philosophy Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Our Philosophy
                </h2>
            </div>
            <div class="space-y-8">
                <div class="bg-white p-8 rounded-lg border-l-4 border-[var(--color-forest-green)]">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Regeneration Over Preservation
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed">
                        We go beyond sustainable tourism. Every journey is designed to actively restore ecosystems, 
                        support community-led conservation, and create measurable positive impact. Travel becomes a force for regeneration.
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-lg border-l-4 border-[var(--color-accent-gold)]">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Authentic Encounters, Real Impact
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed">
                        We connect travelers with genuine experiences—from walking safaris with Maasai guides to mangrove 
                        restoration with women-led cooperatives. These encounters create meaningful connections and direct 
                        support for conservation and community initiatives.
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-lg border-l-4 border-[var(--color-forest-green)]">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Luxury Rooted in Purpose
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed">
                        Luxury travel doesn't have to compromise on impact. We curate exceptional accommodations and 
                        experiences that blend comfort with conservation, ensuring every moment reflects both elegance and purpose.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @if($aboutContentImage2)
        <section class="pb-8 bg-[var(--color-off-white)]">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-xl overflow-hidden shadow-lg border border-[var(--color-sand-beige)]">
                    <img src="{{ $aboutContentImage2 }}" alt="About Halisi philosophy image" class="w-full h-[220px] sm:h-[300px] md:h-[380px] object-cover" loading="lazy">
                </div>
            </div>
        </section>
    @endif



    <!-- The 5 Regenerative Pillars - Expanded -->
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    The 5 Regenerative Pillars
                </h2>
                <p class="text-lg text-[var(--color-earth-brown)] max-w-3xl mx-auto">
                    These pillars guide every journey we design and every partnership we form.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">Culture</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">
                        Honoring and supporting traditional knowledge, cultural heritage, and indigenous practices that have sustained communities for generations.
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">Community</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">
                        Investing in local leadership, sustainable livelihoods, and community-led initiatives that create lasting positive change.
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">Conservation</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">
                        Supporting projects that restore degraded landscapes, protect biodiversity, and ensure wildlife and ecosystems thrive for future generations.
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">Change Agents</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">
                        Empowering local leaders, innovators, and initiatives that drive positive transformation in their communities and ecosystems.
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">Climate Action</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">
                        Carbon-neutral journeys and support for climate resilience initiatives that protect communities and ecosystems from climate impacts.
                    </p>
                </div>
            </div>
        </div>
    </section>

  

    <!-- Why Travel With Halisi Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Why Travel With Halisi
                </h2>
            </div>
            
            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-2 h-2 bg-[var(--color-accent-gold)] rounded-full mt-2"></div>
                    <div>
                        <h3 class="text-lg font-semibold text-[var(--color-forest-green)] mb-2">Bespoke Journey Design</h3>
                        <p class="text-[var(--color-earth-brown)] leading-relaxed">
                            Every itinerary is crafted to your interests, values, and travel style. We take time to understand 
                            what matters to you and design experiences that align with your vision of meaningful travel.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-2 h-2 bg-[var(--color-accent-gold)] rounded-full mt-2"></div>
                    <div>
                        <h3 class="text-lg font-semibold text-[var(--color-forest-green)] mb-2">Direct Impact</h3>
                        <p class="text-[var(--color-earth-brown)] leading-relaxed">
                            Your journey directly supports conservation projects and community initiatives. We provide transparent 
                            reporting on how your travel creates positive change, from mangrove restoration to wildlife protection.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-2 h-2 bg-[var(--color-accent-gold)] rounded-full mt-2"></div>
                    <div>
                        <h3 class="text-lg font-semibold text-[var(--color-forest-green)] mb-2">Expert Guidance</h3>
                        <p class="text-[var(--color-earth-brown)] leading-relaxed">
                            Our team includes conservationists, naturalists, and travel experts with deep knowledge of Africa's 
                            ecosystems, cultures, and conservation landscape. Their expertise ensures authentic, meaningful experiences.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-2 h-2 bg-[var(--color-accent-gold)] rounded-full mt-2"></div>
                    <div>
                        <h3 class="text-lg font-semibold text-[var(--color-forest-green)] mb-2">Carbon-Neutral Travel</h3>
                        <p class="text-[var(--color-earth-brown)] leading-relaxed">
                            All journeys are carbon-neutral through verified offset programs and nature-based solutions. 
                            Travel with confidence knowing your footprint is fully addressed.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-2 h-2 bg-[var(--color-accent-gold)] rounded-full mt-2"></div>
                    <div>
                        <h3 class="text-lg font-semibold text-[var(--color-forest-green)] mb-2">Luxury Without Compromise</h3>
                        <p class="text-[var(--color-earth-brown)] leading-relaxed">
                            We partner with exceptional accommodations and curate experiences that blend comfort, authenticity, 
                            and purpose. Luxury travel and positive impact are not mutually exclusive—they're essential partners.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <x-button-primary href="{{ route('contact.index') }}">
                    Design Your Journey
                </x-button-primary>
            </div>
        </div>
    </section>
@endsection
