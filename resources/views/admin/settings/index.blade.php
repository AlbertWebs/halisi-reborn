@extends('admin.layouts.admin')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Company Information Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Company Information
                </h3>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Company Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="company_name" name="company_name" 
                               value="{{ isset($settings['company_name']) ? $settings['company_name']->setting_value : 'Halisi Africa Discoveries' }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>

                    <div>
                        <label for="company_tagline" class="block text-sm font-medium text-gray-700 mb-2">
                            Tagline
                        </label>
                        <input type="text" id="company_tagline" name="company_tagline" 
                               value="{{ isset($settings['company_tagline']) ? $settings['company_tagline']->setting_value : 'Authentic African Journeys, Designed to Regenerate' }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>
                </div>

                <div>
                    <label for="company_address" class="block text-sm font-medium text-gray-700 mb-2">
                        Street Address
                    </label>
                    <input type="text" id="company_address" name="company_address" 
                           value="{{ isset($settings['company_address']) ? $settings['company_address']->setting_value : '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label for="company_city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                        <input type="text" id="company_city" name="company_city" 
                               value="{{ isset($settings['company_city']) ? $settings['company_city']->setting_value : '' }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>
                    <div>
                        <label for="company_state" class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                        <input type="text" id="company_state" name="company_state" 
                               value="{{ isset($settings['company_state']) ? $settings['company_state']->setting_value : '' }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>
                    <div>
                        <label for="company_country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                        <input type="text" id="company_country" name="company_country" 
                               value="{{ isset($settings['company_country']) ? $settings['company_country']->setting_value : '' }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>
                    <div>
                        <label for="company_postal_code" class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                        <input type="text" id="company_postal_code" name="company_postal_code" 
                               value="{{ isset($settings['company_postal_code']) ? $settings['company_postal_code']->setting_value : '' }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="company_phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <input type="text" id="company_phone" name="company_phone" 
                               value="{{ isset($settings['company_phone']) ? $settings['company_phone']->setting_value : '' }}"
                               placeholder="+1 (555) 123-4567"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>
                    <div>
                        <label for="company_email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
                        </label>
                        <input type="email" id="company_email" name="company_email" 
                               value="{{ isset($settings['company_email']) ? $settings['company_email']->setting_value : '' }}"
                               placeholder="info@halisiafrica.com"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>
                    <div>
                        <label for="company_website" class="block text-sm font-medium text-gray-700 mb-2">
                            Website URL
                        </label>
                        <input type="url" id="company_website" name="company_website" 
                               value="{{ isset($settings['company_website']) ? $settings['company_website']->setting_value : '' }}"
                               placeholder="https://www.halisiafrica.com"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>
                </div>
            </div>
        </div>

        <!-- Logos & Branding Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Logos & Branding
                </h3>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Main Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Main Logo
                            <span class="text-xs text-gray-500 ml-1">(Recommended: 300x100px, PNG/SVG)</span>
                        </label>
                        <div class="space-y-3">
                            @if(isset($settings['logo_main']) && $settings['logo_main']->setting_value)
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/' . $settings['logo_main']->setting_value) }}" 
                                         alt="Main Logo" 
                                         class="h-20 object-contain border border-gray-200 rounded-lg p-2 bg-gray-50">
                                    <button type="button" onclick="document.getElementById('logo_main_remove').value = '1'; this.parentElement.style.display='none';" 
                                            class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center cursor-pointer hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <input type="hidden" id="logo_main_remove" name="logo_main_remove" value="0">
                                </div>
                            @endif
                            <input type="file" id="logo_main" name="logo_main" accept="image/jpeg,image/png,image/gif,image/webp,image/svg+xml,image/*"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[var(--color-forest-green)] file:text-white hover:file:bg-opacity-90 cursor-pointer">
                        </div>
                    </div>

                    <!-- Footer Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Footer Logo
                            <span class="text-xs text-gray-500 ml-1">(Recommended: 200x80px, PNG/SVG)</span>
                        </label>
                        <div class="space-y-3">
                            @if(isset($settings['logo_footer']) && $settings['logo_footer']->setting_value)
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/' . $settings['logo_footer']->setting_value) }}" 
                                         alt="Footer Logo" 
                                         class="h-16 object-contain border border-gray-200 rounded-lg p-2 bg-gray-50">
                                    <button type="button" onclick="document.getElementById('logo_footer_remove').value = '1'; this.parentElement.style.display='none';" 
                                            class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center cursor-pointer hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <input type="hidden" id="logo_footer_remove" name="logo_footer_remove" value="0">
                                </div>
                            @endif
                            <input type="file" id="logo_footer" name="logo_footer" accept="image/jpeg,image/png,image/gif,image/webp,image/svg+xml,image/*"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[var(--color-forest-green)] file:text-white hover:file:bg-opacity-90 cursor-pointer">
                        </div>
                    </div>

                    <!-- Icon Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Icon Logo
                            <span class="text-xs text-gray-500 ml-1">(Recommended: 64x64px, PNG/SVG)</span>
                        </label>
                        <div class="space-y-3">
                            @if(isset($settings['logo_icon']) && $settings['logo_icon']->setting_value)
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/' . $settings['logo_icon']->setting_value) }}" 
                                         alt="Icon Logo" 
                                         class="h-16 w-16 object-contain border border-gray-200 rounded-lg p-2 bg-gray-50">
                                    <button type="button" onclick="document.getElementById('logo_icon_remove').value = '1'; this.parentElement.style.display='none';" 
                                            class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center cursor-pointer hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <input type="hidden" id="logo_icon_remove" name="logo_icon_remove" value="0">
                                </div>
                            @endif
                            <input type="file" id="logo_icon" name="logo_icon" accept="image/jpeg,image/png,image/gif,image/webp,image/svg+xml,image/*"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[var(--color-forest-green)] file:text-white hover:file:bg-opacity-90 cursor-pointer">
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Favicon
                            <span class="text-xs text-gray-500 ml-1">(Recommended: 32x32px, ICO/PNG)</span>
                        </label>
                        <div class="space-y-3">
                            @if(isset($settings['favicon']) && $settings['favicon']->setting_value)
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/' . $settings['favicon']->setting_value) }}" 
                                         alt="Favicon" 
                                         class="h-16 w-16 object-contain border border-gray-200 rounded-lg p-2 bg-gray-50">
                                    <button type="button" onclick="document.getElementById('favicon_remove').value = '1'; this.parentElement.style.display='none';" 
                                            class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center cursor-pointer hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <input type="hidden" id="favicon_remove" name="favicon_remove" value="0">
                                </div>
                            @endif
                            <input type="file" id="favicon" name="favicon" accept="image/*,.ico"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[var(--color-forest-green)] file:text-white hover:file:bg-opacity-90 cursor-pointer">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Social Media
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="social_facebook" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Facebook
                        </label>
                        <input type="url" id="social_facebook" name="social_facebook" 
                               value="{{ isset($settings['social_facebook']) ? $settings['social_facebook']->setting_value : '' }}"
                               placeholder="https://facebook.com/halisiafrica"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>

                    <div>
                        <label for="social_instagram" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            Instagram
                        </label>
                        <input type="url" id="social_instagram" name="social_instagram" 
                               value="{{ isset($settings['social_instagram']) ? $settings['social_instagram']->setting_value : '' }}"
                               placeholder="https://instagram.com/halisiafrica"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>

                    <div>
                        <label for="social_twitter" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                            Twitter
                        </label>
                        <input type="url" id="social_twitter" name="social_twitter" 
                               value="{{ isset($settings['social_twitter']) ? $settings['social_twitter']->setting_value : '' }}"
                               placeholder="https://twitter.com/halisiafrica"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>

                    <div>
                        <label for="social_linkedin" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                            LinkedIn
                        </label>
                        <input type="url" id="social_linkedin" name="social_linkedin" 
                               value="{{ isset($settings['social_linkedin']) ? $settings['social_linkedin']->setting_value : '' }}"
                               placeholder="https://linkedin.com/company/halisiafrica"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>

                    <div>
                        <label for="social_youtube" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            YouTube
                        </label>
                        <input type="url" id="social_youtube" name="social_youtube" 
                               value="{{ isset($settings['social_youtube']) ? $settings['social_youtube']->setting_value : '' }}"
                               placeholder="https://youtube.com/@halisiafrica"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>

                    <div>
                        <label for="social_pinterest" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.487.535 6.624 0 11.99-5.367 11.99-11.987C23.97 5.39 18.592.026 11.968.026L12.017 0z"/>
                            </svg>
                            Pinterest
                        </label>
                        <input type="url" id="social_pinterest" name="social_pinterest" 
                               value="{{ isset($settings['social_pinterest']) ? $settings['social_pinterest']->setting_value : '' }}"
                               placeholder="https://pinterest.com/halisiafrica"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Settings Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    SEO Settings
                </h3>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="default_meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Default Meta Title
                        <span class="text-xs text-gray-500 ml-1">(Recommended: 50-60 characters)</span>
                    </label>
                    <input type="text" id="default_meta_title" name="default_meta_title" 
                           value="{{ isset($settings['default_meta_title']) ? $settings['default_meta_title']->setting_value : '' }}"
                           maxlength="60"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    <p class="mt-1 text-xs text-gray-500" id="meta_title_count">0 / 60 characters</p>
                </div>

                <div>
                    <label for="default_meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Default Meta Description
                        <span class="text-xs text-gray-500 ml-1">(Recommended: 150-160 characters)</span>
                    </label>
                    <textarea id="default_meta_description" name="default_meta_description" rows="3" maxlength="160"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">{{ isset($settings['default_meta_description']) ? $settings['default_meta_description']->setting_value : '' }}</textarea>
                    <p class="mt-1 text-xs text-gray-500" id="meta_description_count">0 / 160 characters</p>
                </div>

                <div>
                    <label for="default_meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                        Meta Keywords
                        <span class="text-xs text-gray-500 ml-1">(Comma-separated)</span>
                    </label>
                    <input type="text" id="default_meta_keywords" name="default_meta_keywords" 
                           value="{{ isset($settings['default_meta_keywords']) ? $settings['default_meta_keywords']->setting_value : '' }}"
                           placeholder="africa, travel, safari, luxury, conservation"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-200">
                    <div>
                        <label for="google_analytics_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Google Analytics ID
                            <span class="text-xs text-gray-500 ml-1">(e.g., G-XXXXXXXXXX)</span>
                        </label>
                        <input type="text" id="google_analytics_id" name="google_analytics_id" 
                               value="{{ isset($settings['google_analytics_id']) ? $settings['google_analytics_id']->setting_value : '' }}"
                               placeholder="G-XXXXXXXXXX"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>

                    <div>
                        <label for="google_tag_manager_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Google Tag Manager ID
                            <span class="text-xs text-gray-500 ml-1">(e.g., GTM-XXXXXXX)</span>
                        </label>
                        <input type="text" id="google_tag_manager_id" name="google_tag_manager_id" 
                               value="{{ isset($settings['google_tag_manager_id']) ? $settings['google_tag_manager_id']->setting_value : '' }}"
                               placeholder="GTM-XXXXXXX"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <label for="tinymce_api_key" class="block text-sm font-medium text-gray-700 mb-2">
                        TinyMCE API Key
                        <span class="text-xs text-gray-500 ml-1">(Used for TinyMCE editor integration)</span>
                    </label>
                    <input type="text" id="tinymce_api_key" name="tinymce_api_key"
                           value="{{ isset($settings['tinymce_api_key']) ? $settings['tinymce_api_key']->setting_value : '' }}"
                           placeholder="your-tinymce-api-key"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)] transition-colors">
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4 pt-4">
            <a href="{{ route('admin.dashboard') }}" 
               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium shadow-sm">
                Save All Settings
            </button>
        </div>
    </form>

    <script>
        // Character counter for meta fields
        document.addEventListener('DOMContentLoaded', function() {
            const metaTitle = document.getElementById('default_meta_title');
            const metaTitleCount = document.getElementById('meta_title_count');
            const metaDescription = document.getElementById('default_meta_description');
            const metaDescriptionCount = document.getElementById('meta_description_count');

            function updateCount(input, counter) {
                const count = input.value.length;
                const max = parseInt(input.getAttribute('maxlength'));
                counter.textContent = count + ' / ' + max + ' characters';
                if (count > max * 0.9) {
                    counter.classList.add('text-red-500');
                    counter.classList.remove('text-gray-500');
                } else {
                    counter.classList.remove('text-red-500');
                    counter.classList.add('text-gray-500');
                }
            }

            if (metaTitle && metaTitleCount) {
                updateCount(metaTitle, metaTitleCount);
                metaTitle.addEventListener('input', () => updateCount(metaTitle, metaTitleCount));
            }

            if (metaDescription && metaDescriptionCount) {
                updateCount(metaDescription, metaDescriptionCount);
                metaDescription.addEventListener('input', () => updateCount(metaDescription, metaDescriptionCount));
            }

            // Image preview on file selection
            const fileInputs = ['logo_main', 'logo_footer', 'logo_icon', 'favicon'];
            fileInputs.forEach(inputId => {
                const input = document.getElementById(inputId);
                if (input) {
                    input.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const preview = input.parentElement.querySelector('img');
                                if (preview) {
                                    preview.src = e.target.result;
                                } else {
                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.className = 'h-20 object-contain border border-gray-200 rounded-lg p-2 bg-gray-50 mt-3';
                                    input.parentElement.insertBefore(img, input);
                                }
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }
            });
        });
    </script>
@endsection
