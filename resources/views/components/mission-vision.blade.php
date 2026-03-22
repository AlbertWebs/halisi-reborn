@props([
    'compact' => false,
])

@php
    $pad = $compact ? 'py-12 md:py-16' : 'section-padding';
    $textSize = $compact ? 'text-xs sm:text-sm' : 'text-sm md:text-base';
    $headingSize = $compact ? 'text-xl md:text-2xl' : 'text-2xl md:text-3xl';
@endphp

<section class="{{ $pad }} bg-[var(--color-off-white)] border-y border-[var(--color-sand-beige)]/60" aria-labelledby="mission-heading vision-heading">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Graphic strip: words via icons, not sentences --}}
        <div class="flex flex-wrap justify-center gap-3 md:gap-4 mb-10 md:mb-12 js-scroll">
            <span class="inline-flex items-center gap-2 rounded-[var(--radius-button)] bg-white border border-[var(--color-sand-beige)] px-4 py-2 shadow-sm">
                <svg class="w-5 h-5 text-[var(--color-forest-green)] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span class="text-sm font-semibold text-[var(--color-forest-green)]">Women</span>
            </span>
            <span class="inline-flex items-center gap-2 rounded-[var(--radius-button)] bg-white border border-[var(--color-sand-beige)] px-4 py-2 shadow-sm">
                <svg class="w-5 h-5 text-[var(--color-forest-green)] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-sm font-semibold text-[var(--color-forest-green)]">Planet</span>
            </span>
            <span class="inline-flex items-center gap-2 rounded-[var(--radius-button)] bg-white border border-[var(--color-sand-beige)] px-4 py-2 shadow-sm">
                <svg class="w-5 h-5 text-[var(--color-forest-green)] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="text-sm font-semibold text-[var(--color-forest-green)]">Hosts</span>
            </span>
            <span class="inline-flex items-center gap-2 rounded-[var(--radius-button)] border border-[var(--color-forest-green)] bg-[var(--color-forest-green)] text-white px-4 py-2 shadow-sm">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                <span class="text-sm font-semibold">Tours</span>
            </span>
        </div>

        <div class="text-center mb-8 md:mb-10 js-scroll">
            <p class="text-xs uppercase tracking-[0.2em] text-[var(--color-accent-gold)] font-bold mb-2">Official</p>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)]">Mission &amp; vision</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 js-scroll-stagger">
            {{-- Mission --}}
            <article class="group relative overflow-hidden rounded-2xl bg-white border border-[var(--color-sand-beige)]/80 shadow-sm">
                <div class="absolute top-0 right-0 w-28 h-28 md:w-36 md:h-36 rounded-bl-full bg-[var(--color-forest-green)]/8 pointer-events-none" aria-hidden="true"></div>
                <div class="p-5 md:p-7 flex gap-5 md:gap-6 items-start">
                    <div class="flex-shrink-0 w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-[var(--color-sand-beige)] flex items-center justify-center border border-[var(--color-accent-gold)]/30" aria-hidden="true">
                        <svg class="w-9 h-9 md:w-10 md:h-10 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1 border-l-2 border-[var(--color-accent-gold)]/60 pl-4 md:pl-5">
                        <h3 id="mission-heading" class="{{ $headingSize }} font-serif font-bold text-[var(--color-forest-green)] mb-3">Mission</h3>
                        <p class="{{ $textSize }} text-[var(--color-earth-brown)] leading-relaxed">
                            At Halisi Africa Discoveries our mission is to provide exceptional travel experiences that empower women and promote environmental sustainability. We strive to create meaningful connections between travelers and local communities, while actively working to protect and preserve the natural world.
                        </p>
                    </div>
                </div>
            </article>

            {{-- Vision --}}
            <article class="group relative overflow-hidden rounded-2xl bg-[var(--color-forest-green)] text-white border border-[var(--color-forest-green)] shadow-md">
                <div class="absolute -bottom-8 -left-8 w-32 h-32 rounded-full bg-white/10 pointer-events-none" aria-hidden="true"></div>
                <div class="p-5 md:p-7 flex gap-5 md:gap-6 items-start relative z-10">
                    <div class="flex-shrink-0 w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-white/15 flex items-center justify-center border border-white/25" aria-hidden="true">
                        <svg class="w-9 h-9 md:w-10 md:h-10 text-[var(--color-accent-gold)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1 border-l-2 border-[var(--color-accent-gold)]/70 pl-4 md:pl-5">
                        <h3 id="vision-heading" class="{{ $headingSize }} font-serif font-bold text-white mb-3">Vision</h3>
                        <p class="{{ $textSize }} text-white/90 leading-relaxed">
                            Our vision is to be a leading tour planning company that sets the standard for women empowerment and environmental sustainability in the travel industry. We aim to inspire travelers to explore the world responsibly, supporting local communities and preserving the planet for future generations.
                        </p>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
