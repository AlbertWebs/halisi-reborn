@props([
    'introSection' => null,
    'pillarSections' => [],
    'welcomeGridSections' => [],
])

@php
    /**
     * Welcome 2×2 grid: optional dedicated images (welcome_grid_*) override pillar_* images.
     */
    $welcomePillarDefs = [
        [
            'welcome_key' => 'welcome_grid_culture',
            'pillar_key' => 'pillar_culture',
            'defaultTitle' => 'Culture',
            'altSuffix' => '— heritage and respectful travel',
            'cta' => route('impact.responsible-travel'),
        ],
        [
            'welcome_key' => 'welcome_grid_community',
            'pillar_key' => 'pillar_community',
            'defaultTitle' => 'Community',
            'altSuffix' => '— women-led hosts and local partnerships',
            'cta' => route('impact.climate-community'),
        ],
        [
            'welcome_key' => 'welcome_grid_conservation',
            'pillar_key' => 'pillar_conservation',
            'defaultTitle' => 'Conservation',
            'altSuffix' => '— wildlife and habitat',
            'cta' => route('impact.responsible-travel'),
        ],
        [
            'welcome_key' => 'welcome_grid_climate',
            'pillar_key' => 'pillar_climate_action',
            'defaultTitle' => 'Climate',
            'altSuffix' => '— lighter footprint and nature-based action',
            'cta' => route('impact.climate-community'),
        ],
    ];

    $pillarCollection = $pillarSections instanceof \Illuminate\Support\Collection
        ? $pillarSections
        : collect($pillarSections);

    $welcomeGrid = $welcomeGridSections instanceof \Illuminate\Support\Collection
        ? $welcomeGridSections
        : collect($welcomeGridSections ?? []);
@endphp

<section id="welcome-section" {{ $attributes->merge(['class' => 'welcome-section welcome-section--refined section-padding']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="welcome-split">
            <div class="welcome-split-copy js-scroll js-scroll-fade">
                <div class="welcome-split-copy-inner about-green-copy">
                    <header class="welcome-split-headings">
                        <p class="about-green-intro">{{ $introSection?->subtitle ?: 'Welcome To' }}</p>
                        <h2 class="about-green-title welcome-split-title">
                            {{ $introSection?->title ?: 'Halisi Africa Discoveries' }}
                        </h2>
                    </header>
                    <div class="welcome-split-body">
                        {!! $introSection?->content ?: 'We plan exceptional trips across Africa with two priorities: <strong>empowering women</strong> and <strong>environmental sustainability</strong>. Real hosts, real landscapes—mission and vision unchanged since day one.' !!}
                    </div>
                    <div class="welcome-split-cta">
                        <a
                            href="{{ route('impact.responsible-travel') }}"
                            class="welcome-impact-btn"
                        >
                            Explore Our Impact <span class="welcome-impact-btn-arrow" aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>

            @php
                $welcomeGridImageSrc = function (?string $path): string {
                    if (! filled($path)) {
                        return '';
                    }
                    return \Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])
                        ? $path
                        : asset('storage/' . $path);
                };
            @endphp
            <div class="welcome-pillars-grid js-scroll-stagger" role="list" aria-label="Four focus areas">
                @foreach($welcomePillarDefs as $def)
                    @php
                        $welcomeTile = $welcomeGrid->get($def['welcome_key']);
                        $pillar = $pillarCollection->get($def['pillar_key']);
                        $label = filled($welcomeTile?->title)
                            ? $welcomeTile->title
                            : (filled($pillar?->title) ? $pillar->title : $def['defaultTitle']);
                        if ($welcomeTile && $welcomeTile->image) {
                            $img = $welcomeGridImageSrc($welcomeTile->image);
                        } elseif ($pillar && $pillar->image) {
                            $img = $welcomeGridImageSrc($pillar->image);
                        } else {
                            $img = asset('og-image.jpg');
                        }
                        $href = filled($welcomeTile?->cta_link ?? null)
                            ? $welcomeTile->cta_link
                            : (filled($pillar?->cta_link ?? null) ? $pillar->cta_link : $def['cta']);
                        $alt = $label . ' ' . $def['altSuffix'];
                    @endphp
                    <a
                        href="{{ $href }}"
                        role="listitem"
                        class="welcome-pillar-tile group focus:outline-none focus-visible:ring-2 focus-visible:ring-[#8C864F] focus-visible:ring-offset-2 focus-visible:ring-offset-[#F9F8F3]"
                    >
                        <span class="welcome-pillar-tile-media">
                            <img
                                src="{{ $img }}"
                                alt="{{ $alt }}"
                                class="welcome-pillar-tile-img"
                                width="640"
                                height="640"
                                loading="lazy"
                                decoding="async"
                                sizes="(min-width: 1024px) 25vw, 50vw"
                            >
                            <span class="welcome-pillar-tile-overlay" aria-hidden="true"></span>
                            <span class="welcome-pillar-tile-label">
                                <span class="welcome-pillar-tile-title">{{ $label }}</span>
                            </span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
