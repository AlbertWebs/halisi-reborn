@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Welcome Block -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-2">Welcome back, {{ auth()->user()->name }}!</h2>
        <p class="text-gray-600">Here's an overview of your content.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Journeys</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['journeys'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: rgba(26, 77, 58, 0.1);">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #1a4d3a;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Countries</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['countries'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: rgba(212, 175, 55, 0.15);">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #d4af37;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Articles</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['articles'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Pages</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['pages'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 flex-shrink-0 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.journeys.create') }}" class="flex items-center justify-center px-6 py-3 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Journey
            </a>
            <a href="{{ route('admin.countries.create') }}" class="flex items-center justify-center px-6 py-3 bg-[var(--color-accent-gold)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Country
            </a>
            <a href="{{ route('admin.trust.create') }}" class="flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Article
            </a>
        </div>
    </div>

    <!-- Recent Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Journeys -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Journeys</h3>
            @if($recentJourneys->count() > 0)
                <div class="space-y-3">
                    @foreach($recentJourneys as $journey)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $journey->title }}</p>
                                <p class="text-xs text-gray-500">{{ $journey->created_at->diffForHumans() }}</p>
                            </div>
                            <a href="{{ route('admin.journeys.edit', $journey) }}" class="text-[var(--color-forest-green)] hover:text-opacity-80 text-sm">Edit</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">No journeys yet.</p>
            @endif
        </div>

        <!-- Recent Countries -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Countries</h3>
            @if($recentCountries->count() > 0)
                <div class="space-y-3">
                    @foreach($recentCountries as $country)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $country->name }}</p>
                                <p class="text-xs text-gray-500">{{ $country->created_at->diffForHumans() }}</p>
                            </div>
                            <a href="{{ route('admin.countries.edit', $country) }}" class="text-[var(--color-forest-green)] hover:text-opacity-80 text-sm">Edit</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">No countries yet.</p>
            @endif
        </div>

        <!-- Recent Posts -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Articles</h3>
            @if($recentPosts->count() > 0)
                <div class="space-y-3">
                    @foreach($recentPosts as $post)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $post->title }}</p>
                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                            <a href="{{ route('admin.trust.edit', $post) }}" class="text-[var(--color-forest-green)] hover:text-opacity-80 text-sm">Edit</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">No articles yet.</p>
            @endif
        </div>
    </div>
@endsection
