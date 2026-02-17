<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Halisi Africa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Thin translucent scrollbar for the sidebar (visible but subtle) */
        .thin-scrollbar { -ms-overflow-style: auto; scrollbar-width: thin; }
        .thin-scrollbar::-webkit-scrollbar { width: 8px; }
        .thin-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .thin-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(255,255,255,0.12);
            border-radius: 9999px;
            border: 2px solid transparent; /* spacing to make thumb look thinner */
            background-clip: padding-box;
        }
        .thin-scrollbar:hover::-webkit-scrollbar-thumb { background-color: rgba(255,255,255,0.18); }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col border-r border-gray-700 shadow-md ring-1 ring-gray-800/20">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-800 flex items-center space-x-3">
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
                    <img src="{{url('/')}}/storage/settings/tz8I7K6AX8LnKlWgqWwMqQnmUeK0dyLo0AQ2QUcc.png" alt="Halisi logo" class="w-10 h-10 object-contain rounded" >
                @else
                    <img src="{{ asset('images/logo-main.svg') }}" alt="Halisi default logo" class="w-10 h-10 object-contain rounded">
                @endif

                <div>
                    <h1 class="text-xl font-serif font-bold">Halisi Africa</h1>
                    <p class="text-sm text-gray-400 mt-1">Admin Panel</p>
                </div>

                <!-- View site button relocated into navigation -->
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto thin-scrollbar py-4 px-0">
                <!-- Dashboard -->
                <div class="px-4 mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </div>

                <!-- Content Management -->
                <div class="px-4 mb-4">
                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Content Management</p>
                    
                    <a href="{{ route('admin.homepage.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.homepage.*') ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a1 1 0 001 1h16a1 1 0 001-1V7M8 3h8l1 4H7l1-4z"/></svg>
                        <span class="text-sm">Homepage Sections</span>
                    </a>
                    
                    <a href="{{ route('admin.pages.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.pages.*') ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h7"/></svg>
                        <span class="text-sm">Pages</span>
                    </a>
                    
                    <a href="{{ route('admin.pages.index', ['q' => 'work-with-us']) }}" class="flex items-center px-4 py-2 mt-1 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.pages.*') && request()->get('q') == 'work-with-us' ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span class="text-sm">Work With Us</span>
                    </a>
                    
                    <a href="{{ route('admin.pages.index', ['q' => 'terms-and-conditions']) }}" class="flex items-center px-4 py-2 mt-1 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.pages.*') && request()->get('q') == 'terms-and-conditions' ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                        <span class="text-sm">Terms & Conditions</span>
                    </a>
                    
                    <a href="{{ route('admin.pages.index', ['q' => 'privacy-policy']) }}" class="flex items-center px-4 py-2 mt-1 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.pages.*') && request()->get('q') == 'privacy-policy' ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 1v22M1 12h22"/></svg>
                        <span class="text-sm">Privacy Policy</span>
                    </a>
                    
                    <a href="{{ route('admin.journeys.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.journeys.*') ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3-1.343-3-3S10.343 2 12 2s3 1.343 3 3-1.343 3-3 3zM6 20c0-3.314 2.686-6 6-6s6 2.686 6 6"/></svg>
                        <span class="text-sm">Journeys</span>
                    </a>
                    
                    <a href="{{ route('admin.countries.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.countries.*') ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 100 20 10 10 0 000-20zM2 12h20M12 2v20"/></svg>
                        <span class="text-sm">Countries</span>
                    </a>
                    
                    <a href="{{ route('admin.impact.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.impact.*') ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3v18M4 12h14"/></svg>
                        <span class="text-sm">Impact & Stats</span>
                    </a>
                    
                    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="flex items-center px-4 py-2 mt-2 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3h7v7m0 0L10 14m4-11L5 19" />
                        </svg>
                        <span class="text-sm">View site</span>
                    </a>
                </div>

                <!-- Blog -->
                <div class="px-4 mb-4">
                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Blog</p>
                    
                    <a href="{{ route('admin.trust.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.trust.*') ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V5a2 2 0 00-2-2H7a2 2 0 00-2 2v6"/></svg>
                        <span class="text-sm">All Articles</span>
                    </a>
                    
                    <a href="{{ route('admin.trust.create') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent">
                        <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span class="text-sm">Add Article</span>
                    </a>
                </div>
            </nav>

            <!-- Admin links segment -->
            <div class="px-4 py-3 border-t border-gray-800">
                <p class="px-1 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Administration</p>
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('admin.footer.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.footer.*') ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                        <span class="text-sm">Footer</span>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-800 transition-colors border-l-4 border-transparent {{ request()->routeIs('admin.settings.*') ? 'bg-gray-800 border-indigo-500' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm8 3a8 8 0 11-16 0 8 8 0 0116 0z"/></svg>
                        <span class="text-sm">Settings</span>
                    </a>
                </div>
            </div>

            <!-- Logout pinned to bottom (only button) -->
            <div class="mt-auto p-4 border-t border-gray-800">
                <div class="flex flex-col space-y-2">
                    <div class="text-xs text-gray-500">v1.0</div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                    @hasSection('breadcrumb')
                        <nav class="text-sm text-gray-500 mt-1">
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
            <main class="flex-1 overflow-y-auto p-6">
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
                const importantIds = ['body_content', 'content', 'narrative_intro', 'country_narrative', 'experience_highlights', 'regenerative_impact', 'signature_experiences', 'conservation_focus'];
                if (textarea.rows && textarea.rows <= 3 && !importantIds.includes(textarea.id)) {
                    console.log('Skipping small textarea: ' + textarea.id);
                    return;
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
                branding: false,
                promotion: false,
                setup: function(editor) {
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
    </script>
</body>
</html>
