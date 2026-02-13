@extends('layouts.app')

@section('title', 'Responsible & Regenerative Travel - Halisi Africa')
@section('description', 'Learn how Halisi Africa creates regenerative travel experiences that restore ecosystems, support communities, and address climate change through nature-based solutions.')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[60vh] flex items-center justify-center bg-[var(--color-forest-green)] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance">
                Responsible & Regenerative Travel
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-2xl mx-auto">
                Our commitment to climate-positive travel and ecosystem restoration
            </p>
        </div>
    </section>

    <!-- What Regenerative Tourism Means Section -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    What Regenerative Tourism Means at Halisi
                </h2>
            </div>
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] mb-8">
                <p class="text-lg leading-relaxed mb-6">
                    Regenerative tourism goes beyond sustainability. While sustainable tourism aims to minimize negative impact, 
                    regenerative tourism actively restores and improves the ecosystems and communities it touches. At Halisi Africa, 
                    every journey is designed to leave destinations better than we found them.
                </p>
                <p class="text-lg leading-relaxed mb-6">
                    This means direct support for conservation projects, community-led initiatives, and nature-based solutions 
                    that address climate change. It means travelers become active participants in restoration, not passive observers. 
                    It means measurable positive impact that extends far beyond the duration of a journey.
                </p>
            </div>
            
            <!-- Pull Quote -->
            <div class="bg-[var(--color-off-white)] border-l-4 border-[var(--color-forest-green)] p-8 my-12">
                <blockquote class="text-2xl font-serif italic text-[var(--color-forest-green)] mb-4">
                    "Travel should regenerate, not just preserve. Every journey must leave more than footprints—it must leave legacy."
                </blockquote>
                <cite class="text-sm text-[var(--color-earth-brown)]">— Halisi Africa Philosophy</cite>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Responsible Travel Practices Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Responsible Travel Practices
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="bg-white p-8 rounded-lg">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Community-Led Partnerships
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4">
                        We partner exclusively with community-led initiatives and locally-owned accommodations. This ensures 
                        that tourism revenue stays within communities, supports local economies, and empowers local decision-making 
                        about how tourism develops in their regions.
                    </p>
                    <ul class="list-disc list-inside text-[var(--color-earth-brown)] space-y-2 ml-4">
                        <li>Minimum 70% of accommodation revenue goes to local ownership</li>
                        <li>All guides and staff are from local communities</li>
                        <li>Community benefit agreements for all conservation partnerships</li>
                    </ul>
                </div>
                
                <div class="bg-white p-8 rounded-lg">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Wildlife Protection Standards
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4">
                        We adhere to strict wildlife viewing guidelines that prioritize animal welfare and ecosystem health. 
                        All wildlife experiences are designed to minimize disturbance and support conservation efforts.
                    </p>
                    <ul class="list-disc list-inside text-[var(--color-earth-brown)] space-y-2 ml-4">
                        <li>Maintain safe distances from wildlife at all times</li>
                        <li>Support anti-poaching initiatives through direct funding</li>
                        <li>Partner only with conservation areas that meet international standards</li>
                        <li>No captive wildlife experiences or unethical interactions</li>
                    </ul>
                </div>
                
                <div class="bg-white p-8 rounded-lg">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Cultural Respect & Authenticity
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4">
                        We facilitate authentic cultural exchanges that respect local traditions, support cultural preservation, 
                        and ensure communities benefit from sharing their heritage.
                    </p>
                    <ul class="list-disc list-inside text-[var(--color-earth-brown)] space-y-2 ml-4">
                        <li>Community consent and involvement in all cultural experiences</li>
                        <li>Fair compensation for cultural guides and performers</li>
                        <li>Support for cultural preservation initiatives</li>
                        <li>Education for travelers on respectful cultural engagement</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Carbon Conscious Travel Section -->
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Carbon Conscious Travel & Offsetting
                </h2>
            </div>
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] mb-8">
                <p class="text-lg leading-relaxed mb-6">
                    We recognize that travel has a carbon footprint. That's why every Halisi Africa journey is carbon-neutral 
                    through a comprehensive approach that combines reduction, efficiency, and verified offset programs.
                </p>
            </div>
            
            <!-- Impact Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <x-impact-stat number="100%" label="Carbon Neutral Journeys" />
                <x-impact-stat number="150%" label="Offset Target (Net Positive)" />
                <x-impact-stat number="Verified" label="Gold Standard Offsets" />
            </div>
            
            <div class="bg-[var(--color-off-white)] p-8 rounded-lg">
                <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                    Our Carbon Strategy
                </h3>
                <div class="space-y-4 text-[var(--color-earth-brown)]">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-2 h-2 bg-[var(--color-accent-gold)] rounded-full mt-2"></div>
                        <div>
                            <strong>Reduce:</strong> We minimize emissions through efficient routing, ground transportation 
                            where possible, and partnerships with accommodations that prioritize renewable energy.
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-2 h-2 bg-[var(--color-accent-gold)] rounded-full mt-2"></div>
                        <div>
                            <strong>Offset:</strong> All remaining emissions are offset through Gold Standard verified projects, 
                            including reforestation, renewable energy, and community-based carbon reduction initiatives.
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-2 h-2 bg-[var(--color-accent-gold)] rounded-full mt-2"></div>
                        <div>
                            <strong>Restore:</strong> We go beyond offsetting by directly supporting nature-based solutions 
                            that sequester carbon while restoring ecosystems and supporting communities.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-section-divider />

    <!-- Climate Action Through Nature-Based Solutions Section -->
    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-8"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-6">
                    Climate Action Through Nature-Based Solutions
                </h2>
            </div>
            
            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] mb-8">
                <p class="text-lg leading-relaxed mb-6">
                    Nature-based solutions harness the power of ecosystems to address climate change while providing 
                    co-benefits for biodiversity and communities. At Halisi Africa, we integrate these solutions directly 
                    into our travel experiences.
                </p>
            </div>
            
            <div class="space-y-8">
                <div class="bg-white p-8 rounded-lg">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Mangrove Restoration
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4">
                        Mangroves are among the most effective carbon sinks on Earth, sequestering up to four times more 
                        carbon than tropical rainforests. Through our "One Tourist = One Mangrove" program, every journey 
                        directly supports mangrove restoration projects led by women's cooperatives in coastal communities.
                    </p>
                    <div class="mt-6 p-4 bg-[var(--color-off-white)] rounded">
                        <div class="text-2xl font-serif font-bold text-[var(--color-forest-green)] mb-2">1:1</div>
                        <div class="text-sm text-[var(--color-earth-brown)]">One Tourist = One Mangrove Planted</div>
                    </div>
                </div>
                
                <div class="bg-white p-8 rounded-lg">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Reforestation & Afforestation
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4">
                        We support community-led reforestation projects that restore degraded landscapes, create wildlife 
                        corridors, and provide sustainable livelihoods through agroforestry and forest products.
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-lg">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Grassland & Savanna Restoration
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4">
                        Healthy grasslands and savannas are critical carbon sinks and essential for wildlife. We support 
                        initiatives that restore these ecosystems through sustainable grazing practices, controlled burns, 
                        and community-led conservation.
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-lg">
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Climate-Resilient Agriculture
                    </h3>
                    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4">
                        We partner with community initiatives that promote climate-resilient agricultural practices, 
                        reducing emissions while improving food security and supporting local economies.
                    </p>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <x-button-primary href="{{ route('impact.climate-community') }}">
                    Learn More About Climate & Community Impact
                </x-button-primary>
            </div>
        </div>
    </section>
@endsection
