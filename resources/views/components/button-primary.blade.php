@props(['href' => null, 'type' => 'button', 'ariaLabel' => null])

@if($href)
    <a href="{{ $href }}" 
       @if($ariaLabel) aria-label="{{ $ariaLabel }}" @endif
       {{ $attributes->merge(['class' => 'inline-block px-6 py-3 bg-[var(--color-forest-green)] text-white font-semibold uppercase tracking-wide hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:ring-offset-2 transition-colors']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" 
            @if($ariaLabel) aria-label="{{ $ariaLabel }}" @endif
            {{ $attributes->merge(['class' => 'px-6 py-3 bg-[var(--color-forest-green)] text-white font-semibold uppercase tracking-wide hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-[var(--color-forest-green)] focus:ring-offset-2 transition-colors']) }}>
        {{ $slot }}
    </button>
@endif
