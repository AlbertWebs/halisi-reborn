@extends('layouts.app')

@section('title', 'Privacy Policy - Halisi Africa Discoveries')
@section('description', 'Privacy Policy for Halisi Africa Discoveries.')

@section('content')
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 js-scroll">
                <div class="w-24 h-0.5 bg-[var(--color-accent-gold)] mb-6"></div>
                <h1 class="text-3xl md:text-4xl font-serif font-bold text-[var(--color-forest-green)] mb-4">
                    Privacy Policy
                </h1>
                <p class="text-sm text-[var(--color-earth-brown)]">Last updated: {{ date('F j, Y') }}</p>
            </div>

            <div class="prose prose-lg max-w-none text-[var(--color-earth-brown)] js-scroll js-scroll-fade">
                <p>
                    We respect your privacy and are committed to protecting your personal information.
                    This page explains how we collect, use, and protect your data when you use our website
                    and contact our team.
                </p>
                <h2>Information We Collect</h2>
                <p>
                    We may collect details you provide directly, such as your name, email address, and
                    inquiry details submitted through our contact and subscription forms.
                </p>
                <h2>How We Use Information</h2>
                <p>
                    We use your information to respond to inquiries, provide requested updates, improve
                    our services, and maintain website security and anti-spam protections.
                </p>
                <h2>Third-Party Services</h2>
                <p>
                    Our website may use third-party tools and embeds. These providers may process data
                    according to their own privacy policies.
                </p>
                <h2>Your Rights</h2>
                <p>
                    You may request access, correction, or removal of your personal information by
                    contacting us via the Contact page.
                </p>
            </div>
        </div>
    </section>
@endsection
