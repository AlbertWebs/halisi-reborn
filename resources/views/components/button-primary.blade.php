@props(['href' => null, 'type' => 'button'])

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-block px-6 py-3 bg-[var(--color-forest-green)] text-white font-semibold uppercase tracking-wide hover:bg-opacity-90 transition-colors']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'px-6 py-3 bg-[var(--color-forest-green)] text-white font-semibold uppercase tracking-wide hover:bg-opacity-90 transition-colors']) }}>
        {{ $slot }}
    </button>
@endif
