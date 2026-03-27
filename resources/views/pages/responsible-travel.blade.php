@extends('layouts.app')

@section('title', $page?->meta_title ?: 'Responsible & Regenerative Travel - Halisi Africa')
@section('description', $page?->meta_description ?: 'How we travel: women’s empowerment, environmental sustainability, and lower-impact journeys across Africa.')

@push('styles')
<style>
    .impact-section-label { letter-spacing: 0.2em; }
    .impact-card { transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease; }
    .impact-card:hover { transform: translateY(-4px); box-shadow: 0 16px 34px rgba(26, 77, 58, 0.16); border-color: rgba(26, 77, 58, 0.2); }
    .impact-glass-band {
        background:
            radial-gradient(ellipse 110% 60% at 50% 0%, rgba(212, 175, 55, 0.14) 0%, transparent 52%),
            radial-gradient(ellipse 55% 40% at 100% 40%, rgba(97, 172, 69, 0.12) 0%, transparent 50%),
            radial-gradient(ellipse 60% 38% at 0% 80%, rgba(26, 77, 58, 0.36) 0%, transparent 52%),
            linear-gradient(165deg, #15271f 0%, #1a3228 42%, #1f3d31 74%, #152920 100%);
    }
    .impact-body p + p { margin-top: 1rem; }
    .impact-body h2, .impact-body h3 { color: var(--color-forest-green); font-family: var(--font-serif); }
    .impact-carbon-zone {
        background:
            radial-gradient(ellipse 90% 55% at 50% -10%, rgba(212, 175, 55, 0.18) 0%, transparent 55%),
            radial-gradient(ellipse 50% 45% at 100% 60%, rgba(97, 172, 69, 0.14) 0%, transparent 50%),
            radial-gradient(ellipse 45% 40% at 0% 100%, rgba(0, 0, 0, 0.35) 0%, transparent 55%),
            linear-gradient(180deg, #0c1a14 0%, #143528 38%, #1a4d3a 55%, #0f241c 100%);
    }
    .impact-carbon-stat {
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.12) 0%, rgba(255, 255, 255, 0.04) 100%);
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.12);
    }
    .impact-nature-shell {
        background:
            linear-gradient(180deg, rgba(250, 249, 246, 0.98) 0%, rgba(232, 220, 196, 0.35) 45%, rgba(250, 249, 246, 1) 100%);
    }
</style>
@endpush

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

        $impactHeroImage = $resolvePageImage($page?->hero_image);
        $impactContentImage1 = $resolvePageImage($page?->content_image_1);
        $impactContentImage2 = $resolvePageImage($page?->content_image_2);
    @endphp

    <!-- Hero Section -->
    <section class="relative min-h-[72vh] flex items-center justify-center bg-[var(--color-forest-green)] text-white overflow-hidden">
        @if($impactHeroImage)
            <img src="{{ $impactHeroImage }}" alt="{{ $page?->hero_title ?: 'Responsible & Regenerative Travel' }}" class="absolute inset-0 w-full h-full object-cover" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/45 to-black/20"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-forest-green)] via-[var(--color-earth-brown)]/80 to-[var(--color-forest-green)]"></div>
        @endif
        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <nav class="js-scroll mb-8" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-white/85 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back to home
                </a>
            </nav>
            <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-4">Our commitment</p>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6 text-balance drop-shadow-sm">
                {{ $page?->hero_title ?: 'Responsible & Regenerative Travel' }}
            </h1>
            <p class="text-lg md:text-2xl text-white/95 max-w-3xl mx-auto leading-relaxed">
                {{ $page?->hero_subtext ?: 'Same mission: empower women · protect the environment' }}
            </p>
            <div class="w-28 h-0.5 bg-[var(--color-accent-gold)]/85 mx-auto mt-8"></div>
        </div>
    </section>

    <section class="section-padding bg-[var(--color-off-white)] text-[var(--color-earth-brown)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 js-scroll">
                <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3">Travel that does more</p>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">What we protect and grow</h2>
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 js-scroll-stagger">
                <div class="rounded-2xl border border-[var(--color-sand-beige)]/80 bg-white p-6 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-off-white)] border border-[var(--color-sand-beige)] flex items-center justify-center mx-auto mb-3 text-[var(--color-accent-gold)]" aria-hidden="true">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z"/></svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-[var(--color-forest-green)] mb-2">Women-led livelihoods</h3>
                    <p class="text-sm text-[var(--color-earth-brown)]/85">Income, leadership, and decision-making where travel happens.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-sand-beige)]/80 bg-white p-6 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-off-white)] border border-[var(--color-sand-beige)] flex items-center justify-center mx-auto mb-3 text-[var(--color-accent-gold)]" aria-hidden="true">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-[var(--color-forest-green)] mb-2">Habitat and climate</h3>
                    <p class="text-sm text-[var(--color-earth-brown)]/85">Lower footprint journeys and investments in nature-based solutions.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-sand-beige)]/80 bg-white p-6 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-off-white)] border border-[var(--color-sand-beige)] flex items-center justify-center mx-auto mb-3 text-[var(--color-accent-gold)]" aria-hidden="true">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-[var(--color-forest-green)] mb-2">Respectful exchange</h3>
                    <p class="text-sm text-[var(--color-earth-brown)]/85">Culture shared by invitation, with dignity and fair value.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll text-center mb-10">
                <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3">Approach</p>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)]">Our responsible travel framework</h2>
            </div>
            <div class="impact-body js-scroll bg-[var(--color-off-white)] border border-[var(--color-sand-beige)]/70 rounded-2xl p-6 md:p-10 text-[var(--color-earth-brown)] leading-relaxed">
                {!! filled($page?->body_content) ? html_entity_decode($page->body_content, ENT_QUOTES | ENT_HTML5, 'UTF-8') : '<p>Exceptional travel should leave places stronger than we found them. Our framework starts with women-led local partnerships, protects wildlife habitats, and channels part of every journey into restoration and climate work.</p><p>Every itinerary is designed to reduce harm first: better routing, thoughtful supplier choices, and practical guest guidance. Then we invest in verified climate and community initiatives that return value to local ecosystems and livelihoods.</p>' !!}
            </div>
        </div>
    </section>

    @if($impactContentImage1)
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="js-scroll rounded-2xl overflow-hidden shadow-md border border-[var(--color-sand-beige)]/50">
                    <img src="{{ $impactContentImage1 }}" alt="Responsible travel" class="w-full aspect-[21/9] sm:aspect-[3/1] object-cover" loading="lazy">
                </div>
            </div>
        </section>
    @endif

    

    <section class="section-padding bg-[var(--color-off-white)]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll text-center mb-12">
                <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3">Practices</p>
                <div class="w-16 h-0.5 bg-[var(--color-accent-gold)] mx-auto mb-6"></div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)]">
                    On the ground standards
                </h2>
            </div>
            
            <div class="js-scroll-stagger grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-forest-green)]/10 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Community-led
                    </h3>
                    <ul class="list-none space-y-2.5 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Local-owned stays where we can</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Guides &amp; staff from the area</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Benefits agreed with communities</li>
                    </ul>
                </div>
                
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-forest-green)]/10 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Wildlife
                    </h3>
                    <ul class="list-none space-y-2.5 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Space for animals first</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Anti-poaching we can fund</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> No captive “selfies”</li>
                    </ul>
                </div>
                
                <div class="impact-card bg-white p-8 rounded-xl shadow-sm border border-[var(--color-sand-beige)]/40">
                    <div class="w-12 h-12 rounded-full bg-[var(--color-forest-green)]/10 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[var(--color-forest-green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">
                        Culture
                    </h3>
                    <ul class="list-none space-y-2.5 text-[var(--color-earth-brown)] text-sm">
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Visits only when hosts agree</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Fair pay for guides</li>
                        <li class="flex items-start gap-2"><span class="text-[var(--color-accent-gold)] mt-0.5 shrink-0" aria-hidden="true">◆</span> Guests briefed on respect</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @if($impactContentImage2)
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="js-scroll rounded-2xl overflow-hidden shadow-md border border-[var(--color-sand-beige)]/50">
                    <img src="{{ $impactContentImage2 }}" alt="Climate action" class="w-full aspect-[21/9] sm:aspect-[3/1] object-cover" loading="lazy">
                </div>
            </div>
        </section>
    @endif



    <section class="impact-carbon-zone section-padding-lg text-white relative overflow-hidden" aria-labelledby="carbon-accountability-heading">
        <div class="pointer-events-none absolute inset-0 opacity-[0.07]" aria-hidden="true" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="js-scroll text-center mb-12 md:mb-14">
                <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-4">Carbon</p>
                <h2 id="carbon-accountability-heading" class="text-3xl sm:text-4xl md:text-5xl font-serif font-bold text-white text-balance mb-6">
                    Carbon accountability
                </h2>
                <p class="text-base md:text-lg text-white/85 max-w-2xl mx-auto leading-relaxed">
                    Trips are planned <strong class="text-[var(--color-accent-gold)] font-semibold">carbon-neutral</strong>: we cut waste and inefficiency first, then invest in verified offsets for what remains.
                </p>
                <div class="w-28 h-0.5 bg-gradient-to-r from-transparent via-[var(--color-accent-gold)] to-transparent mx-auto mt-8"></div>
            </div>

            <div class="js-scroll-stagger grid grid-cols-1 sm:grid-cols-3 gap-5 md:gap-6 mb-12 md:mb-14">
                <div class="impact-carbon-stat impact-card rounded-2xl p-8 md:p-9 text-center">
                    <div class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-[var(--color-accent-gold)] mb-2 leading-none">100%</div>
                    <div class="text-[0.7rem] sm:text-xs uppercase tracking-[0.16em] text-white/75 font-semibold">Carbon-neutral trips</div>
                    <p class="text-sm text-white/60 mt-4 leading-snug">Every journey balanced through reduction + offsets.</p>
                </div>
                <div class="impact-carbon-stat impact-card rounded-2xl p-8 md:p-9 text-center ring-1 ring-[var(--color-accent-gold)]/35">
                    <div class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-2 leading-none">150%</div>
                    <div class="text-[0.7rem] sm:text-xs uppercase tracking-[0.16em] text-white/75 font-semibold">Offset ambition</div>
                    <p class="text-sm text-white/60 mt-4 leading-snug">We aim beyond neutral where projects allow.</p>
                </div>
                <div class="impact-carbon-stat impact-card rounded-2xl p-8 md:p-9 text-center">
                    <div class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-white mb-2 leading-tight pt-1">Verified</div>
                    <div class="text-[0.7rem] sm:text-xs uppercase tracking-[0.16em] text-white/75 font-semibold">Gold Standard calibre</div>
                    <p class="text-sm text-white/60 mt-4 leading-snug">Rigorous projects with measurable climate outcomes.</p>
                </div>
            </div>

            <div class="js-scroll rounded-3xl border border-white/15 bg-black/25 backdrop-blur-md p-6 sm:p-8 md:p-10 shadow-[0_24px_80px_rgba(0,0,0,0.35)]">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8 md:mb-10 pb-6 border-b border-white/10">
                    <div>
                        <h3 class="text-xl md:text-2xl font-serif font-semibold text-white">How we close the loop</h3>
                        <p class="text-sm text-white/65 mt-2 max-w-xl">Three deliberate steps—so climate action is visible, not vague.</p>
                    </div>
                    <span class="inline-flex items-center self-start md:self-auto rounded-full border border-[var(--color-accent-gold)]/50 bg-[var(--color-accent-gold)]/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-[var(--color-accent-gold)]">Reduce · Offset · Restore</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-6">
                    <div class="relative md:pr-4">
                        <div class="hidden md:block absolute top-6 left-[2.25rem] right-0 h-px bg-gradient-to-r from-white/25 to-transparent" aria-hidden="true"></div>
                        <div class="flex gap-4">
                            <span class="w-12 h-12 shrink-0 rounded-2xl bg-[var(--color-accent-gold)] text-[var(--color-forest-green)] flex items-center justify-center font-serif font-bold text-lg shadow-lg" aria-hidden="true">1</span>
                            <div>
                                <span class="text-[var(--color-accent-gold)] font-bold text-xs uppercase tracking-[0.14em]">Reduce</span>
                                <p class="text-sm text-white/80 leading-relaxed mt-2">Smarter routing, less waste, and greener stays wherever the itinerary allows.</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative md:pr-4">
                        <div class="hidden md:block absolute top-6 left-[2.25rem] right-0 h-px bg-gradient-to-r from-white/25 to-transparent" aria-hidden="true"></div>
                        <div class="flex gap-4">
                            <span class="w-12 h-12 shrink-0 rounded-2xl bg-white/15 border border-white/25 text-white flex items-center justify-center font-serif font-bold text-lg" aria-hidden="true">2</span>
                            <div>
                                <span class="text-[var(--color-accent-gold)] font-bold text-xs uppercase tracking-[0.14em]">Offset</span>
                                <p class="text-sm text-white/80 leading-relaxed mt-2">High-integrity credits for emissions we cannot eliminate on the trip itself.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-12 h-12 shrink-0 rounded-2xl bg-white/15 border border-white/25 text-white flex items-center justify-center font-serif font-bold text-lg" aria-hidden="true">3</span>
                        <div>
                            <span class="text-[var(--color-accent-gold)] font-bold text-xs uppercase tracking-[0.14em]">Restore</span>
                            <p class="text-sm text-white/80 leading-relaxed mt-2">Mangroves, trees, and grasslands—carbon storage that supports people and wildlife.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="impact-nature-shell section-padding-lg relative overflow-hidden" aria-labelledby="land-water-heading">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-[var(--color-accent-gold)] to-transparent opacity-90" aria-hidden="true"></div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-2">
            <div class="js-scroll flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-12 md:mb-14">
                <div class="max-w-2xl">
                    <p class="impact-section-label text-xs uppercase tracking-widest text-[var(--color-accent-gold)] font-semibold mb-3">Nature-based solutions</p>
                    <h2 id="land-water-heading" class="text-3xl md:text-4xl lg:text-[2.75rem] font-serif font-bold text-[var(--color-forest-green)] text-balance leading-tight">
                        Land &amp; water that store carbon—and livelihoods
                    </h2>
                </div>
                <p class="text-sm md:text-base text-[var(--color-earth-brown)] max-w-md lg:text-right leading-relaxed lg:pb-1">
                    Restoration isn’t decoration: it’s how travel dollars return to soils, coasts, and communities for the long term.
                </p>
            </div>

            <div class="js-scroll-stagger grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-6">
                <div class="impact-card group relative bg-white rounded-2xl border border-[var(--color-forest-green)]/10 shadow-md p-6 md:p-8 overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[var(--color-accent-gold)] rounded-l-2xl" aria-hidden="true"></div>
                    <div class="w-11 h-11 rounded-xl bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-4" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">Mangroves</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed mb-5">Dense coastal carbon · women’s co-ops and shoreline resilience.</p>
                    <div class="inline-flex items-baseline gap-2 rounded-xl bg-[var(--color-off-white)] border border-[var(--color-sand-beige)] px-4 py-2.5">
                        <span class="text-2xl font-serif font-bold text-[var(--color-forest-green)]">1:1</span>
                        <span class="text-xs uppercase tracking-wide text-[var(--color-earth-brown)]">Guest · tree planted</span>
                    </div>
                </div>

                <div class="impact-card bg-white rounded-2xl border border-[var(--color-forest-green)]/10 shadow-md p-6 md:p-8">
                    <div class="w-11 h-11 rounded-xl bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-4" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">Trees</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">Community-led planting and corridors that connect fragmented habitat.</p>
                </div>

                <div class="impact-card bg-white rounded-2xl border border-[var(--color-forest-green)]/10 shadow-md p-6 md:p-8">
                    <div class="w-11 h-11 rounded-xl bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-4" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">Grasslands</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">Regenerative grazing and fire where it helps—carbon held in living soil.</p>
                </div>

                <div class="impact-card bg-white rounded-2xl border border-[var(--color-forest-green)]/10 shadow-md p-6 md:p-8">
                    <div class="w-11 h-11 rounded-xl bg-[var(--color-sand-beige)] flex items-center justify-center text-[var(--color-forest-green)] mb-4" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-2">Farms</h3>
                    <p class="text-sm text-[var(--color-earth-brown)] leading-relaxed">More resilient crops, less waste, and better food sourced close to the journey.</p>
                </div>
            </div>

            <div class="js-scroll mt-12 md:mt-14 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('impact.climate-community') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-[var(--radius-button)] bg-[var(--color-forest-green)] text-white font-semibold uppercase tracking-[0.06em] text-sm shadow-lg hover:shadow-xl hover:bg-[#153d2e] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)] focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-off-white)] transition-all duration-200">
                    Climate &amp; community
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('trust.index') }}" class="text-sm font-semibold text-[var(--color-forest-green)] underline underline-offset-4 decoration-[var(--color-accent-gold)]/70 hover:text-[var(--color-earth-brown)] transition-colors">
                    Read field notes on impact
                </a>
            </div>
        </div>
    </section>

@endsection
