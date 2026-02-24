@extends('layouts.app')

@section('title', 'Explore Africa by Country - Halisi Africa Discoveries')
@section('description', 'Discover authentic African experiences across Kenya, Uganda, Tanzania, Zambia, Zimbabwe, Botswana, and Namibia.')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-12 js-scroll">Explore Africa by Country</h1>
        
        @if($countries->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 js-scroll-stagger">
                @foreach($countries as $country)
                    <x-country-card 
                        name="{{ $country->name }}" 
                        slug="{{ $country->slug }}"
                        image="{{ $country->hero_image }}"
                        excerpt="{{ Str::limit($country->country_narrative, 100) }}"
                    />
                @endforeach
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 js-scroll-stagger">
                <x-country-card name="Kenya" slug="kenya" />
                <x-country-card name="Uganda" slug="uganda" />
                <x-country-card name="Tanzania" slug="tanzania" />
                <x-country-card name="Zambia" slug="zambia" />
                <x-country-card name="Zimbabwe" slug="zimbabwe" />
                <x-country-card name="Botswana" slug="botswana" />
                <x-country-card name="Namibia" slug="namibia" />
            </div>
        @endif
    </div>
@endsection
