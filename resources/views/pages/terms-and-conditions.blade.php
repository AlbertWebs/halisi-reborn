@extends('layouts.app')

@section('title', 'Terms and Conditions - Halisi Africa Discoveries')
@section('description', 'Terms and Conditions for Halisi Africa Discoveries.')

@section('content')
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h1 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    Terms and Conditions
                </h1>
                <p class="text-sm text-[var(--color-earth-brown)]">Last updated: {{ date('F j, Y') }}</p>
            </div>

            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] js-scroll js-scroll-fade">
                <p>
                    By using this website, you agree to these terms. If you do not agree, please do not
                    use the site.
                </p>
                <h2>Website Use</h2>
                <p>
                    Content is provided for general information and planning purposes. Availability,
                    pricing, itineraries, and inclusions are subject to change.
                </p>
                <h2>Bookings and Services</h2>
                <p>
                    Booking terms, payment schedules, cancellation terms, and liability details are
                    provided during the formal booking process and may vary by itinerary and supplier.
                </p>
                <h2>Intellectual Property</h2>
                <p>
                    Unless otherwise stated, website content is owned by Halisi Africa Discoveries and may
                    not be reproduced without permission.
                </p>
                <h2>Contact</h2>
                <p>
                    For questions regarding these terms, please contact us through the Contact page.
                </p>
            </div>
        </div>
    </section>
@endsection
