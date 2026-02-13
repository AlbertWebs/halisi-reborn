@props(['title', 'description', 'icon' => null])

<div class="bg-white rounded-lg shadow-md p-6 lg:p-8 hover:shadow-lg transition-all duration-300">
    @if($icon)
        <div class="mb-6 flex items-center justify-center w-16 h-16 bg-[var(--color-sand-beige)] rounded-full">
            {!! $icon !!}
        </div>
    @endif
    <h3 class="text-xl lg:text-2xl font-serif font-semibold text-[var(--color-forest-green)] mb-4">{{ $title }}</h3>
    <p class="text-[var(--color-earth-brown)] leading-relaxed mb-4">{{ $description }}</p>
    @isset($button)
        <div class="mt-6">
            {{ $button }}
        </div>
    @endisset
</div>
