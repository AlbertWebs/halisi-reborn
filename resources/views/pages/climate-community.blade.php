@extends('layouts.app')

@section('title', 'Climate & Community Impact - Halisi Africa Discoveries')
@section('description', 'Discover how Halisi Africa creates measurable positive impact through women-led restoration, conservation partnerships, and climate action initiatives across Africa.')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[70vh] flex items-center justify-center bg-[var(--color-forest-green)] text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60 z-10"></div>
            <div class="w-full h-full bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)] to-[var(--color-forest-green)]"></div>
        </div>
        
        <div class="relative z-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                Impact Beyond the Itinerary
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto leading-relaxed">
                Our commitment to women-led restoration, conservation, and climate action across Africa.
            </p>
        </div>
    </section>

    <!-- Women-Led Mangrove Restoration Section -->
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="mb-8">
                        <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                            Women-Led Mangrove Restoration
                        </h2>
                    </div>
                    
                    <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] mb-8">
                        <p class="text-lg leading-relaxed mb-6">
                            Through the Halisi Trust, we partner with women-led cooperatives in coastal communities across East Africa 
                            to restore mangrove ecosystems—one of the most effective nature-based solutions for climate change.
                        </p>
                        <p class="text-lg leading-relaxed">
                            Our "One Tourist = One Mangrove" program ensures that every journey directly supports mangrove planting 
                            initiatives, creating measurable carbon sequestration while empowering women as environmental stewards 
                            and community leaders.
                        </p>
                    </div>
                    
                    <div class="mt-8">
                        <x-button-secondary href="{{ route('trust.index') }}">
                            Learn More About Halisi Trust
                        </x-button-secondary>
                    </div>
                </div>
                
                <!-- Stat Blocks -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-[var(--color-off-white)] p-8 rounded-lg text-center border border-[var(--color-sand-beige)]">
                        <div class="text-5xl font-serif font-bold text-[var(--color-forest-green)] mb-2" data-count="100">0</div>
                        <div class="text-sm uppercase tracking-wide text-[var(--color-earth-brown)]">Mangroves Planted</div>
                    </div>
                    <div class="bg-[var(--color-off-white)] p-8 rounded-lg text-center border border-[var(--color-sand-beige)]">
                        <div class="text-5xl font-serif font-bold text-[var(--color-forest-green)] mb-2" data-count="30">0</div>
                        <div class="text-sm uppercase tracking-wide text-[var(--color-earth-brown)]">Women Reached</div>
                    </div>
                    <div class="bg-[var(--color-off-white)] p-8 rounded-lg text-center border border-[var(--color-sand-beige)] col-span-2">
                        <div class="text-3xl font-serif font-bold text-[var(--color-forest-green)] mb-2">1:1</div>
                        <div class="text-sm uppercase tracking-wide text-[var(--color-earth-brown)]">One Tourist = One Mangrove</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Seedball Safaris Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Seedball Safaris
                </h2>
            </div>
            
            <div class="bg-white p-8 rounded-lg mb-8">
                <div class="flex items-center gap-6 mb-6">
                    <div class="w-20 h-20 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-10 h-10 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">
                            Ethical Guest Participation in Reforestation
                        </h3>
                    </div>
                </div>
                
                <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)]">
                    <p class="text-lg leading-relaxed mb-4">
                        Seedball Safaris offer travelers a meaningful way to participate in ecosystem restoration during their journey. 
                        Unlike traditional voluntourism, our approach is designed with dignity, respect, and genuine impact in mind.
                    </p>
                    <p class="text-lg leading-relaxed mb-4">
                        Guests work alongside local conservationists and community members to plant native tree species using seedball 
                        technology—a method that protects seeds and increases germination rates. This hands-on experience creates 
                        deeper connections to the land while contributing to long-term reforestation goals.
                    </p>
                    <p class="text-lg leading-relaxed">
                        All activities are led by local experts, respect community protocols, and are designed to create lasting 
                        environmental benefits rather than performative gestures. This is regenerative travel in action.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Community Partnerships Section -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Community Partnerships
                </h2>
            </div>
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] mb-8">
                <p class="text-xl leading-relaxed mb-6">
                    Our impact is built on long-term collaboration with local communities, not short-term interventions. 
                    We partner with community-led initiatives, respecting local leadership and ensuring that conservation 
                    and restoration efforts are owned and directed by those who call these landscapes home.
                </p>
                <p class="text-lg leading-relaxed mb-6">
                    Every partnership begins with listening. We work with communities to understand their priorities, 
                    challenges, and visions for the future. Our role is to support, amplify, and resource their initiatives— 
                    not to impose external solutions.
                </p>
                <p class="text-lg leading-relaxed">
                    This approach ensures dignity, sustainability, and genuine transformation. When communities lead, 
                    conservation succeeds, and regeneration becomes possible.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-[var(--color-off-white)] p-6 rounded-lg">
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-3">Long-Term Commitment</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">
                        Multi-year partnerships that evolve with community needs and priorities.
                    </p>
                </div>
                <div class="bg-[var(--color-off-white)] p-6 rounded-lg">
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-3">Local Leadership</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">
                        Communities direct priorities and decision-making in all initiatives.
                    </p>
                </div>
                <div class="bg-[var(--color-off-white)] p-6 rounded-lg">
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-forest-green)] mb-3">Dignity First</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">
                        Respectful collaboration that honors traditional knowledge and local expertise.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Conservation Outcomes Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Conservation Outcomes
                </h2>
                <p class="text-lg text-[var(--color-earth-brown)] max-w-3xl mx-auto">
                    Measurable impact across wildlife protection, ecosystem restoration, and regenerative metrics.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Wildlife Impact -->
                <div class="bg-white p-8 rounded-lg">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">Wildlife Impact</h3>
                    <ul class="space-y-2 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Direct funding for anti-poaching initiatives</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Habitat restoration and corridor creation</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Species recovery program support</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Community-based wildlife monitoring</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Ecosystem Protection -->
                <div class="bg-white p-8 rounded-lg">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">Ecosystem Protection</h3>
                    <ul class="space-y-2 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Mangrove restoration and protection</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Reforestation and afforestation projects</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Grassland and savanna restoration</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Watershed protection initiatives</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Regenerative Metrics -->
                <div class="bg-white p-8 rounded-lg">
                    <div class="w-16 h-16 bg-[var(--color-sand-beige)] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">Regenerative Metrics</h3>
                    <ul class="space-y-2 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Carbon sequestration through nature-based solutions</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Community livelihood improvements</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Women's leadership development</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[var(--color-accent-gold)] mt-1">•</span>
                            <span>Long-term ecosystem health indicators</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- CTA Block -->
    <section class="section-padding bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold mb-6">
                Travel as a Force for Regeneration
            </h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Join us in creating journeys that restore ecosystems, empower communities, and address climate change.
            </p>
            <x-button-primary href="{{ route('contact.index') }}" class="bg-white text-[var(--color-forest-green)] hover:bg-gray-100 text-lg px-10 py-5 border-0">
                Design Your Journey
            </x-button-primary>
        </div>
    </section>
@endsection
