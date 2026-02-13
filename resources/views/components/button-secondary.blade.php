@props(['href' => null, 'type' => 'button', 'ariaLabel' => null])

@if($href)
    <a href="{{ $href }}" 
       @if($ariaLabel) aria-label="{{ $ariaLabel }}" @endif
       {{ $attributes->merge(['class' => 'inline-block px-6 py-3 border-2 border-[var(--color-forest-green)] text-[var(--color-forest-green)] font-semibold uppercase tracking-wide hover:bg-[var(--color-forest-green)] hover:text-white focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:ring-offset-2 transition-colors']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" 
            @if($ariaLabel) aria-label="{{ $ariaLabel }}" @endif
            {{ $attributes->merge(['class' => 'px-6 py-3 border-2 border-[var(--color-forest-green)] text-[var(--color-forest-green)] font-semibold uppercase tracking-wide hover:bg-[var(--color-forest-green)] hover:text-white focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:ring-offset-2 transition-colors']) }}>
        {{ $slot }}
    </button>
@endif
