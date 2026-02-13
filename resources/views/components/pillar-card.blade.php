@props(['title', 'description', 'icon' => null])

<div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
    @if($icon)
        <div class="mb-4 text-4xl">{{ $icon }}</div>
    @endif
    <h3 class="text-xl font-serif font-semibold text-[var(--color-forest-green)] mb-3">{{ $title }}</h3>
    <p class="text-[var(--color-earth-brown)]">{{ $description }}</p>
    @isset($button)
        {{ $button }}
    @endisset
</div>
