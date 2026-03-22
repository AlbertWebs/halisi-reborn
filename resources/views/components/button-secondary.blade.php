@props(['href' => null, 'type' => 'button', 'ariaLabel' => null])

@if($href)
    <a href="{{ $href }}" 
       @if($ariaLabel) aria-label="{{ $ariaLabel }}" @endif
       {{ $attributes->merge(['class' => 'inline-block px-6 py-3 rounded-[var(--radius-button)] border border-[var(--color-forest-green)] bg-transparent text-[var(--color-forest-green)] font-semibold uppercase tracking-[0.04em] hover:bg-[var(--color-forest-green)] hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)] focus-visible:ring-offset-2 transition-colors duration-200']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" 
            @if($ariaLabel) aria-label="{{ $ariaLabel }}" @endif
            {{ $attributes->merge(['class' => 'px-6 py-3 rounded-[var(--radius-button)] border border-[var(--color-forest-green)] bg-transparent text-[var(--color-forest-green)] font-semibold uppercase tracking-[0.04em] hover:bg-[var(--color-forest-green)] hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)] focus-visible:ring-offset-2 transition-colors duration-200']) }}>
        {{ $slot }}
    </button>
@endif
