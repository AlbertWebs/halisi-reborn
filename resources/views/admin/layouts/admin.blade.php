<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Halisi Africa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-xl font-serif font-bold">Halisi Africa</h1>
                <p class="text-sm text-gray-400 mt-1">Admin Panel</p>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">
                <!-- Dashboard -->
                <div class="px-4 mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </div>

                <!-- Content Management -->
                <div class="px-4 mb-4">
                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Content Management</p>
                    
                    <a href="{{ route('admin.homepage.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.homepage.*') ? 'bg-gray-800' : '' }}">
                        <span class="text-sm">Homepage Sections</span>
                    </a>
                    
                    <a href="{{ route('admin.pages.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.pages.*') ? 'bg-gray-800' : '' }}">
                        <span class="text-sm">Pages</span>
                    </a>
                    
                    <a href="{{ route('admin.journeys.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.journeys.*') ? 'bg-gray-800' : '' }}">
                        <span class="text-sm">Journeys</span>
                    </a>
                    
                    <a href="{{ route('admin.countries.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.countries.*') ? 'bg-gray-800' : '' }}">
                        <span class="text-sm">Countries</span>
                    </a>
                    
                    <a href="{{ route('admin.impact.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.impact.*') ? 'bg-gray-800' : '' }}">
                        <span class="text-sm">Impact & Stats</span>
                    </a>
                </div>

                <!-- Blog -->
                <div class="px-4 mb-4">
                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Blog</p>
                    
                    <a href="{{ route('admin.trust.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.trust.*') ? 'bg-gray-800' : '' }}">
                        <span class="text-sm">All Articles</span>
                    </a>
                    
                    <a href="{{ route('admin.trust.create') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors">
                        <span class="text-sm">Add Article</span>
                    </a>
                </div>

                <!-- Settings -->
                <div class="px-4 mb-4">
                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Settings</p>
                    
                    <a href="{{ route('admin.footer.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.footer.*') ? 'bg-gray-800' : '' }}">
                        <span class="text-sm">Footer</span>
                    </a>
                    
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-gray-800' : '' }}">
                        <span class="text-sm">Site Settings</span>
                    </a>
                </div>
            </nav>
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
