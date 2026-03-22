@props([
    'label' => 'Image',
    'size' => 'wide', // wide | gallery
])

@php
    $heightClass = $size === 'gallery'
        ? 'min-h-0 aspect-[4/3] w-full'
        : 'w-full h-[220px] sm:h-[300px] md:h-[380px]';
@endphp

<div
    {{ $attributes->class('relative overflow-hidden rounded-xl border-2 border-dashed border-[var(--color-sand-beige)]/80 bg-[var(--color-off-white)] flex items-center justify-center ' . $heightClass) }}
    role="img"
    aria-label="{{ $label }} — placeholder"
>
    <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-sand-beige)]/35 via-transparent to-[var(--color-forest-green)]/8 pointer-events-none" aria-hidden="true"></div>
    <div class="absolute inset-0 opacity-[0.07] pointer-events-none" style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%231a4d3a' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;);" aria-hidden="true"></div>
    <div class="relative z-10 flex flex-col items-center justify-center gap-2 md:gap-3 px-4 text-center">
        <svg class="w-12 h-12 md:w-14 md:h-14 text-[var(--color-forest-green)]/35" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.25" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span class="text-[0.65rem] sm:text-xs font-semibold uppercase tracking-[0.2em] text-[var(--color-earth-brown)]/50">{{ $label }}</span>
    </div>
</div>
