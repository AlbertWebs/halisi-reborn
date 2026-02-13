@props(['href' => null, 'type' => 'button'])

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-block px-6 py-3 border-2 border-[var(--color-forest-green)] text-[var(--color-forest-green)] font-semibold uppercase tracking-wide hover:bg-[var(--color-forest-green)] hover:text-white transition-colors']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'px-6 py-3 border-2 border-[var(--color-forest-green)] text-[var(--color-forest-green)] font-semibold uppercase tracking-wide hover:bg-[var(--color-forest-green)] hover:text-white transition-colors']) }}>
        {{ $slot }}
    </button>
@endif
