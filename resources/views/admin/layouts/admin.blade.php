<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Halisi Africa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Sidebar nav: scrollable, scrollbar hidden */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        /* Admin sidebar: refreshed UI */
        .admin-sidebar {
            background: radial-gradient(1200px 600px at 20% -10%, rgba(212,175,55,0.12), transparent 55%),
                        radial-gradient(900px 520px at 80% 0%, rgba(99,102,241,0.10), transparent 50%),
                        linear-gradient(180deg, #0b1220 0%, #0a0f1a 100%);
        }
        .admin-nav-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.6rem 0.75rem;
            border-radius: 0.75rem;
            color: rgba(229,231,235,0.92);
            transition: background-color .15s ease, color .15s ease, transform .12s ease;
        }
        .admin-nav-item:hover {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.98);
        }
        .admin-nav-item:active { transform: translateY(0.5px); }
        .admin-nav-item--active {
            background: rgba(255,255,255,0.08);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08);
        }
        .admin-nav-icon {
            width: 1.05rem;
            height: 1.05rem;
            flex: 0 0 auto;
            color: rgba(209,213,219,0.9);
        }
        .admin-nav-item--active .admin-nav-icon {
            color: rgba(255,255,255,0.95);
        }
        .admin-nav-kicker {
            font-size: 0.68rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(156,163,175,0.9);
            font-weight: 600;
        }
        .admin-nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.06);
            margin: 0.75rem 0;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="admin-sidebar w-72 text-white flex flex-col border-r border-white/10 shadow-[0_14px_40px_rgba(0,0,0,0.35)] ring-1 ring-black/20">
            <!-- Logo -->
            <div class="px-6 pt-6 pb-5 border-b border-white/10 flex items-center gap-3">
                @php
                    $logo = \App\Models\SiteSetting::get('logo_main');
                    $logoUrl = null;
                    if ($logo) {
                        if (\Illuminate\Support\Str::startsWith($logo, ['http://', 'https://', 'data:'])) {
                            $logoUrl = $logo;
                        } else {
                            $logoUrl = asset($logo);
                        }
                    }
                @endphp

                @if($logoUrl)
                    <img src="{{url('/')}}/storage/settings/tz8I7K6AX8LnKlWgqWwMqQnmUeK0dyLo0AQ2QUcc.png" alt="Halisi logo" class="w-10 h-10 object-contain rounded-lg ring-1 ring-white/15 bg-white/5 p-1" >
                @else
                    <img src="{{ asset('images/logo-main.svg') }}" alt="Halisi default logo" class="w-10 h-10 object-contain rounded-lg ring-1 ring-white/15 bg-white/5 p-1">
                @endif

                <div>
                    <h1 class="text-lg font-serif font-bold leading-tight">Halisi Africa</h1>
                    <p class="text-xs text-white/60 mt-1 tracking-wide">Admin</p>
                </div>

                <!-- View site button relocated into navigation -->
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav py-5 px-4">
                <!-- Dashboard -->
                @php $isDashboard = request()->routeIs('admin.dashboard'); @endphp
                <div class="mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ $isDashboard ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>
                </div>

                <!-- Website -->
                <div class="mb-5">
                    <p class="px-3 admin-nav-kicker mb-2">Website</p>
                    
                    @php
                        $isHomepage = request()->routeIs('admin.homepage.*') && !request()->routeIs('admin.homepage.welcome-grid.*');
                        $isWelcomeGrid = request()->routeIs('admin.homepage.welcome-grid.*');
                        $isHeroCarousel = request()->routeIs('admin.hero-carousel.*');
                        $isPages = request()->routeIs('admin.pages.*');
                        $q = request()->get('q');
                    @endphp

                    <a href="{{ route('admin.homepage.index') }}" class="admin-nav-item {{ $isHomepage ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 7v10a1 1 0 001 1h16a1 1 0 001-1V7M8 3h8l1 4H7l1-4z" />
                        </svg>
                        <span class="text-sm">Homepage</span>
                    </a>
                    <a href="{{ route('admin.homepage.welcome-grid.edit') }}" class="admin-nav-item {{ $isWelcomeGrid ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm">Welcome images</span>
                    </a>
                    <a href="{{ route('admin.hero-carousel.index') }}" class="admin-nav-item {{ $isHeroCarousel ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8.5 12h7M8.5 8.5h7M8.5 15.5h5" />
                        </svg>
                        <span class="text-sm">Hero carousel</span>
                    </a>
                    
                    <a href="{{ route('admin.pages.index') }}" class="admin-nav-item {{ ($isPages && !filled($q)) ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 7h10M7 11h10M7 15h7" />
                        </svg>
                        <span class="text-sm">Pages</span>
                    </a>
                    
                    <a href="{{ route('admin.pages.index', ['q' => 'work-with-us']) }}" class="admin-nav-item {{ ($isPages && $q == 'work-with-us') ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-sm">Work With Us</span>
                    </a>
                    
                    <a href="{{ route('admin.pages.index', ['q' => 'terms-and-conditions']) }}" class="admin-nav-item {{ ($isPages && $q == 'terms-and-conditions') ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 7h16M4 12h16M4 17h12" />
                        </svg>
                        <span class="text-sm">Terms</span>
                    </a>
                    
                    <a href="{{ route('admin.pages.index', ['q' => 'privacy-policy']) }}" class="admin-nav-item {{ ($isPages && $q == 'privacy-policy') ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 3l7 4v5c0 5-3 8-7 9-4-1-7-4-7-9V7l7-4z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9.5 12l1.6 1.6L14.8 10" />
                        </svg>
                        <span class="text-sm">Privacy</span>
                    </a>
                </div>

                <!-- Travel -->
                @php
                    $isJourneys = request()->routeIs('admin.journeys.*');
                    $isCountries = request()->routeIs('admin.countries.*');
                    $isCategories = request()->routeIs('admin.categories.*');
                @endphp
                <div class="mb-5">
                    <p class="px-3 admin-nav-kicker mb-2">Travel</p>
                    <a href="{{ route('admin.journeys.index') }}" class="admin-nav-item {{ $isJourneys ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 6v15m0-15a3 3 0 100 6m0-6c3 0 6 1 9 3-2 2-4 3-6 3H6c-2 0-4-1-6-3 3-2 6-3 12-3z" />
                        </svg>
                        <span class="text-sm">Journeys</span>
                    </a>
                    <a href="{{ route('admin.countries.index') }}" class="admin-nav-item {{ $isCountries ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 2a10 10 0 100 20 10 10 0 000-20zM2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20" />
                        </svg>
                        <span class="text-sm">Countries</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="admin-nav-item {{ $isCategories ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 8h10M7 12h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                        </svg>
                        <span class="text-sm">Categories</span>
                    </a>
                </div>

                <!-- Impact -->
                @php $isImpact = request()->routeIs('admin.impact.*'); @endphp
                <div class="mb-5">
                    <p class="px-3 admin-nav-kicker mb-2">Impact</p>
                    <a href="{{ route('admin.impact.index') }}" class="admin-nav-item {{ $isImpact ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 19V5m0 14h16M8 15V9m4 6V7m4 8v-4" />
                        </svg>
                        <span class="text-sm">Impact & stats</span>
                    </a>
                </div>

                <!-- Billing -->
                @php
                    $isBillingDashboard = request()->routeIs('admin.billing.dashboard');
                    $isBillingClients = request()->routeIs('admin.billing.clients.*');
                    $isBillingInvoices = request()->routeIs('admin.billing.invoices.*');
                    $isBillingPayments = request()->routeIs('admin.billing.payments.*');
                @endphp
                <div class="mb-5">
                    <p class="px-3 admin-nav-kicker mb-2">Billing</p>
                    <a href="{{ route('admin.billing.dashboard') }}" class="admin-nav-item {{ $isBillingDashboard ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 7h16v10H4z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 10h6M7 13h4" />
                        </svg>
                        <span class="text-sm">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.billing.clients.index') }}" class="admin-nav-item {{ $isBillingClients ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 21v-1a4 4 0 00-4-4H6a4 4 0 00-4 4v1" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12a4 4 0 100-8 4 4 0 000 8z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M22 21v-1a3 3 0 00-3-3h-1" />
                        </svg>
                        <span class="text-sm">Clients</span>
                    </a>
                    <a href="{{ route('admin.billing.invoices.index') }}" class="admin-nav-item {{ $isBillingInvoices ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 3h8l2 2v16H7z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 11h6M9 15h6" />
                        </svg>
                        <span class="text-sm">Invoices</span>
                    </a>
                    <a href="{{ route('admin.billing.payments.index') }}" class="admin-nav-item {{ $isBillingPayments ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 7h16v10H4z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 12a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="text-sm">Payments</span>
                    </a>
                </div>

                <!-- Blog -->
                @php
                    $isTrustIndex = request()->routeIs('admin.trust.index');
                    $isTrustCreate = request()->routeIs('admin.trust.create');
                    $isTrustOther = request()->routeIs('admin.trust.*') && !$isTrustIndex && !$isTrustCreate;
                @endphp
                <div class="mb-4">
                    <p class="px-3 admin-nav-kicker mb-2">Halisi Trust</p>
                    <a href="{{ route('admin.trust.index') }}" class="admin-nav-item {{ ($isTrustIndex || $isTrustOther) ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 10h16M4 14h10M4 18h12" />
                        </svg>
                        <span class="text-sm">Articles</span>
                    </a>
                    <a href="{{ route('admin.trust.create') }}" class="admin-nav-item {{ $isTrustCreate ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 5v14M5 12h14" />
                        </svg>
                        <span class="text-sm">New article</span>
                    </a>
                </div>

                <!-- Administration -->
                <div class="admin-nav-divider"></div>
                @php
                    $isFooter = request()->routeIs('admin.footer.*');
                    $isSettings = request()->routeIs('admin.settings.*');
                @endphp
                <div class="mb-4">
                    <p class="px-3 admin-nav-kicker mb-2">Administration</p>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="admin-nav-item">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M14 3h7v7" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M10 14L21 3" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M5 21l5-5" />
                        </svg>
                        <span class="text-sm">View site</span>
                    </a>
                    <a href="{{ route('admin.footer.index') }}" class="admin-nav-item {{ $isFooter ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 7h16M4 12h16M4 17h10" />
                        </svg>
                        <span class="text-sm">Footer</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="admin-nav-item {{ $isSettings ? 'admin-nav-item--active' : '' }}">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19.4 15a7.8 7.8 0 00.1-1 7.8 7.8 0 00-.1-1l2-1.6-2-3.4-2.4 1a7.3 7.3 0 00-1.7-1L15 2h-6l-.4 2.9a7.3 7.3 0 00-1.7 1l-2.4-1-2 3.4L4.6 13a7.8 7.8 0 00-.1 1 7.8 7.8 0 00.1 1L2.6 16.6l2 3.4 2.4-1a7.3 7.3 0 001.7 1L9 22h6l.4-2.9a7.3 7.3 0 001.7-1l2.4 1 2-3.4-2-1.6z" />
                        </svg>
                        <span class="text-sm">Settings</span>
                    </a>
                </div>
            </nav>

            <!-- Logout pinned to bottom (only button) -->
            <div class="mt-auto px-6 py-5 border-t border-white/10">
                <div class="flex flex-col gap-3">
                    <div class="text-[11px] text-white/40 tracking-[0.14em] uppercase">v1.0</div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-white/7 hover:bg-white/10 text-white border border-white/10 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
                            <span class="text-sm font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-3.5 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 leading-tight">@yield('page-title', 'Dashboard')</h2>
                    @hasSection('breadcrumb')
                        <nav class="text-xs text-gray-500 mt-1">
                            @yield('breadcrumb')
                        </nav>
                    @endif
                </div>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-3 text-gray-700 hover:text-gray-900 focus:outline-none">
                        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-600 font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <span class="font-medium">{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-5 text-[0.95rem]">
                @if(session('success'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- TinyMCE - API key loaded from Site Settings -->
    @php
        $tinyMceApiKey = \App\Models\SiteSetting::get('tinymce_api_key', 'no-api-key');
    @endphp
    <script src="https://cdn.tiny.cloud/1/{{ $tinyMceApiKey }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <script>
        // Initialize TinyMCE on all textareas
        function initTinyMCE() {
            if (typeof tinymce === 'undefined') {
                console.log('TinyMCE not loaded yet, retrying...');
                setTimeout(initTinyMCE, 200);
                return;
            }

            console.log('TinyMCE loaded! Initializing editors...');
            
            // Find all textareas with IDs
            const textareas = document.querySelectorAll('textarea[id]');
            console.log('Found ' + textareas.length + ' textareas');
            
            if (textareas.length === 0) {
                console.log('No textareas found, retrying...');
                setTimeout(initTinyMCE, 200);
                return;
            }
            
            // Get list of textarea IDs to initialize
            const textareaIds = [];
            textareas.forEach(function(textarea) {
                // Skip if already initialized
                if (textarea.hasAttribute('data-tinymce-initialized')) {
                    return;
                }

                // Skip very small textareas (like meta descriptions with 2-3 rows)
                // But include important ones
                const importantIds = [
                    'body_content',
                    'content',
                    'narrative_intro',
                    'country_narrative',
                    'experience_highlights',
                    'regenerative_impact',
                    'signature_experiences',
                    'conservation_focus',
                    'highlight_1_text',
                    'highlight_2_text',
                    'highlight_3_text',
                    'highlight_4_text'
                ];
                if (textarea.rows && textarea.rows <= 3 && !importantIds.includes(textarea.id)) {
                    console.log('Skipping small textarea: ' + textarea.id);
                    return;
                }

                // TinyMCE hides the source textarea; native required validation
                // can block submit with "invalid form control is not focusable".
                // Keep validation on the backend for editor-managed fields.
                if (textarea.hasAttribute('required')) {
                    textarea.setAttribute('data-was-required', 'true');
                    textarea.removeAttribute('required');
                }

                textareaIds.push(textarea.id);
                textarea.setAttribute('data-tinymce-initialized', 'true');
            });

            if (textareaIds.length === 0) {
                console.log('No textareas to initialize');
                return;
            }

            console.log('Initializing TinyMCE for: ' + textareaIds.join(', '));

            // Initialize TinyMCE
            tinymce.init({
                selector: '#' + textareaIds.join(', #'),
                height: 400,
                menubar: true,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | link image | code fullscreen | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                automatic_uploads: true,
                images_upload_handler: function (blobInfo, progress) {
                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    return fetch("{{ route('admin.trust.editor-image') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin',
                        body: formData
                    }).then(function (response) {
                        if (!response.ok) {
                            throw new Error('Image upload failed (' + response.status + ')');
                        }
                        return response.json();
                    }).then(function (json) {
                        if (!json || typeof json.location !== 'string') {
                            throw new Error('Invalid upload response');
                        }
                        return json.location;
                    });
                },
                branding: false,
                promotion: false,
                setup: function(editor) {
                    editor.on('change keyup undo redo', function() {
                        editor.save();
                    });
                    console.log('TinyMCE initialized for: ' + editor.id);
                }
            });
        }

        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(initTinyMCE, 300);
            });
        } else {
            setTimeout(initTinyMCE, 300);
        }

        window.addEventListener('load', function() {
            setTimeout(initTinyMCE, 500);
        });

        document.addEventListener('submit', function() {
            if (typeof tinymce !== 'undefined') {
                tinymce.triggerSave();
            }
        });
    </script>
</body>
</html>
