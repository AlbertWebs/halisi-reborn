@props(['type' => 'organization', 'data' => []])


@if($type === 'organization')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Halisi Africa Discoveries",
    "url": "{{ url('/') }}",
    "logo": "{{ url('/logo.png') }}",
    "description": "Authentic African Journeys, Designed to Regenerate",
    "sameAs": [
        "https://www.facebook.com/halisiafrica",
        "https://www.instagram.com/halisiafrica",
        "https://www.twitter.com/halisiafrica",
        "https://www.linkedin.com/company/halisiafrica"
    ],
    "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "Customer Service",
        "url": "{{ route('contact.index') }}"
    }
}
</script>
@endverbatim
@endif


@if($type === 'article')
@php
    $articleData = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $data['title'] ?? '',
        'description' => $data['description'] ?? '',
        'image' => $data['image'] ?? url('/og-image.jpg'),
        'datePublished' => $data['published_at'] ?? '',
        'dateModified' => $data['updated_at'] ?? $data['published_at'] ?? '',
        'author' => [
            '@type' => 'Organization',
            'name' => 'Halisi Africa Discoveries'
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Halisi Africa Discoveries',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => url('/logo.png')
            ]
        ]
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($articleData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($type === 'breadcrumb')
@php
    $breadcrumbData = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => collect($data['items'] ?? [])->map(function($item, $index) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url']
            ];
        })->toArray()
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($breadcrumbData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
