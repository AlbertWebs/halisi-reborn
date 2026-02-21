@php
    $isActive = fn ($route) => request()->routeIs($route);
@endphp
<nav id="mobile-bottom-nav" class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-[var(--color-sand-beige)] pt-1.5 pb-[max(0.5rem,env(safe-area-inset-bottom))] shadow-[0_-8px_32px_rgba(0,0,0,0.08)] w-full" aria-label="Mobile bottom navigation">
    <div class="grid grid-cols-5 min-h-[3.5rem] gap-1 px-1.5 w-full max-w-[100vw] box-border">
        <a href="{{ route('home') }}" class="mobile-bottom-nav-item flex flex-col items-center justify-center gap-0.5 rounded-lg py-1.5 transition-all duration-200 min-h-[40px] {{ $isActive('home') ? 'text-[var(--color-nav-active)] bg-[var(--color-nav-active)]/10' : 'text-[var(--color-earth-brown)] active:bg-black/5' }}">
            <span class="relative flex items-center justify-center">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="{{ $isActive('home') ? '2.25' : '1.75' }}" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                @if($isActive('home'))
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-[var(--color-nav-active)]"></span>
                @endif
            </span>
            <span class="text-[10px] font-semibold uppercase tracking-wide">Home</span>
        </a>
        <a href="{{ route('journeys.index') }}" class="mobile-bottom-nav-item flex flex-col items-center justify-center gap-0.5 rounded-lg py-1.5 transition-all duration-200 min-h-[40px] {{ $isActive('journeys.*') ? 'text-[var(--color-nav-active)] bg-[var(--color-nav-active)]/10' : 'text-[var(--color-earth-brown)] active:bg-black/5' }}">
            <span class="relative flex items-center justify-center">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="{{ $isActive('journeys.*') ? '2.25' : '1.75' }}" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                </svg>
                @if($isActive('journeys.*'))
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-[var(--color-nav-active)]"></span>
                @endif
            </span>
            <span class="text-[10px] font-semibold uppercase tracking-wide">Journeys</span>
        </a>
        <a href="{{ route('countries.index') }}" class="mobile-bottom-nav-item flex flex-col items-center justify-center gap-0.5 rounded-lg py-1.5 transition-all duration-200 min-h-[40px] {{ $isActive('countries.*') ? 'text-[var(--color-nav-active)] bg-[var(--color-nav-active)]/10' : 'text-[var(--color-earth-brown)] active:bg-black/5' }}">
            <span class="relative flex items-center justify-center">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="{{ $isActive('countries.*') ? '2.25' : '1.75' }}" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                @if($isActive('countries.*'))
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-[var(--color-nav-active)]"></span>
                @endif
            </span>
            <span class="text-[10px] font-semibold uppercase tracking-wide">Explore</span>
        </a>
        <a href="{{ route('trust.index') }}" class="mobile-bottom-nav-item flex flex-col items-center justify-center gap-0.5 rounded-lg py-1.5 transition-all duration-200 min-h-[40px] {{ $isActive('trust.*') ? 'text-[var(--color-nav-active)] bg-[var(--color-nav-active)]/10' : 'text-[var(--color-earth-brown)] active:bg-black/5' }}">
            <span class="relative flex items-center justify-center">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="{{ $isActive('trust.*') ? '2.25' : '1.75' }}" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657-2.2-5-2-6.5.5-1.2 2 .1 4.7 2.3 6.6L12 19l4.2-3.9c2.2-1.9 3.5-4.6 2.3-6.6-1.5-2.5-4.843-2.7-6.5-.5z"></path>
                </svg>
                @if($isActive('trust.*'))
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-[var(--color-nav-active)]"></span>
                @endif
            </span>
            <span class="text-[10px] font-semibold uppercase tracking-wide">Trust</span>
        </a>
        <a href="{{ route('contact.index') }}" class="mobile-bottom-nav-item flex flex-col items-center justify-center gap-0.5 rounded-lg py-1.5 transition-all duration-200 min-h-[40px] {{ $isActive('contact.*') ? 'text-[var(--color-nav-active)] bg-[var(--color-nav-active)]/10' : 'text-[var(--color-earth-brown)] active:bg-black/5' }}">
            <span class="relative flex items-center justify-center">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="{{ $isActive('contact.*') ? '2.25' : '1.75' }}" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                @if($isActive('contact.*'))
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-[var(--color-nav-active)]"></span>
                @endif
            </span>
            <span class="text-[10px] font-semibold uppercase tracking-wide">Contact</span>
        </a>
    </div>
</nav>
