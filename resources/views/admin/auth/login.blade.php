@php
    $companyName = \App\Models\SiteSetting::get('company_name', 'Halisi Africa Discoveries');
    $logo = \App\Models\SiteSetting::get('logo_main') ?: \App\Models\SiteSetting::get('logo_footer');
    $logoUrl = null;
    if ($logo) {
        $logoUrl = \Illuminate\Support\Str::startsWith($logo, ['http://', 'https://', 'data:'])
            ? $logo
            : (\Illuminate\Support\Str::startsWith($logo, 'storage/') ? asset($logo) : asset('storage/' . ltrim($logo, '/')));
    }
    if (! $logoUrl && file_exists(public_path('images/logo-main.svg'))) {
        $logoUrl = asset('images/logo-main.svg');
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin sign in &mdash; {{ $companyName }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700&display=swap" rel="stylesheet">
    <style>
        .admin-login {
            --al-green: #1a4d3a;
            --al-green-deep: #0f3328;
            --al-green-light: #2d6b4a;
            --al-gold: #d4af37;
            --al-sand: #e8dcc4;
            --al-offwhite: #faf9f6;
            --al-muted: #6b4e3d;
            min-height: 100vh;
            min-height: 100dvh;
            display: grid;
            grid-template-columns: 1fr;
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: var(--al-offwhite);
        }
        @media (min-width: 1024px) {
            .admin-login { grid-template-columns: 1fr 1fr; }
        }
        .admin-login-brand {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem 2rem 2rem;
            color: #fff;
            overflow: hidden;
            background:
                radial-gradient(ellipse 80% 60% at 20% 0%, rgba(212, 175, 55, 0.18), transparent 55%),
                radial-gradient(ellipse 70% 50% at 100% 100%, rgba(45, 107, 74, 0.35), transparent 50%),
                linear-gradient(155deg, var(--al-green-deep) 0%, var(--al-green) 45%, var(--al-green-light) 100%);
        }
        @media (max-width: 1023px) {
            .admin-login-brand {
                min-height: auto;
                padding: 2rem 1.5rem 1.75rem;
            }
        }
        .admin-login-brand::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0.07;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }
        .admin-login-brand-inner { position: relative; z-index: 1; }
        .admin-login-kicker {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.75);
            margin-bottom: 1.25rem;
        }
        .admin-login-headline {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(1.75rem, 4vw, 2.35rem);
            font-weight: 700;
            line-height: 1.15;
            max-width: 16ch;
            margin: 0 0 1rem;
        }
        .admin-login-tagline {
            font-size: 0.95rem;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.82);
            max-width: 28rem;
            margin: 0;
        }
        .admin-login-rule {
            width: 3.5rem;
            height: 3px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--al-gold), rgba(212, 175, 55, 0.4));
            margin: 1.5rem 0 0;
        }
        .admin-login-brand-footer {
            position: relative;
            z-index: 1;
            margin-top: 2rem;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.55);
        }
        .admin-login-brand-footer a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
        }
        .admin-login-brand-footer a:hover { text-decoration: underline; }
        .admin-login-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.25rem 2.5rem;
        }
        @media (min-width: 1024px) {
            .admin-login-panel { padding: 3rem 2.5rem; }
        }
        .admin-login-card {
            width: 100%;
            max-width: 26rem;
        }
        .admin-login-card-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .admin-login-logo {
            height: 52px;
            width: auto;
            max-width: 200px;
            object-fit: contain;
            margin: 0 auto 1rem;
            display: block;
        }
        .admin-login-card-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--al-green);
            margin: 0 0 0.35rem;
        }
        .admin-login-card-sub {
            font-size: 0.875rem;
            color: var(--al-muted);
            margin: 0;
        }
        .admin-login-alert {
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
            padding: 0.875rem 1rem;
            margin-bottom: 1.25rem;
            border-radius: 0.75rem;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            font-size: 0.875rem;
            line-height: 1.45;
        }
        .admin-login-alert svg { flex-shrink: 0; margin-top: 0.1rem; }
        .admin-login-field { margin-bottom: 1.15rem; }
        .admin-login-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }
        .admin-login-input-wrap {
            position: relative;
        }
        .admin-login-input-icon {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.15rem;
            height: 1.15rem;
            color: #9ca3af;
            pointer-events: none;
        }
        .admin-login-input {
            width: 100%;
            padding: 0.7rem 0.9rem 0.7rem 2.65rem;
            font-size: 0.9375rem;
            border: 1px solid #e5e0d5;
            border-radius: 0.65rem;
            background: #fff;
            color: #1f2937;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .admin-login-input--password { padding-right: 2.75rem; }
        .admin-login-input:focus {
            outline: none;
            border-color: var(--al-green);
            box-shadow: 0 0 0 3px rgba(26, 77, 58, 0.12);
        }
        .admin-login-input::placeholder { color: #9ca3af; }
        .admin-login-toggle-pw {
            position: absolute;
            right: 0.65rem;
            top: 50%;
            transform: translateY(-50%);
            padding: 0.35rem;
            border: none;
            background: transparent;
            color: #6b7280;
            cursor: pointer;
            border-radius: 0.35rem;
        }
        .admin-login-toggle-pw:hover { color: var(--al-green); }
        .admin-login-toggle-pw:focus-visible {
            outline: 2px solid var(--al-green);
            outline-offset: 2px;
        }
        .admin-login-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .admin-login-remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--al-muted);
            cursor: pointer;
            user-select: none;
        }
        .admin-login-remember input {
            width: 1rem;
            height: 1rem;
            accent-color: var(--al-green);
            cursor: pointer;
        }
        .admin-login-submit {
            width: 100%;
            padding: 0.85rem 1.25rem;
            font-size: 0.9375rem;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, var(--al-green) 0%, var(--al-green-light) 100%);
            border: none;
            border-radius: 9999px;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(26, 77, 58, 0.28);
            transition: transform 0.15s ease, box-shadow 0.15s ease, opacity 0.15s ease;
        }
        .admin-login-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(26, 77, 58, 0.32);
        }
        .admin-login-submit:active { transform: translateY(0); }
        .admin-login-submit:focus-visible {
            outline: 2px solid var(--al-gold);
            outline-offset: 3px;
        }
        .admin-login-panel-footer {
            margin-top: 1.75rem;
            text-align: center;
            font-size: 0.8125rem;
            color: #9ca3af;
        }
        .admin-login-panel-footer a {
            color: var(--al-green);
            font-weight: 600;
            text-decoration: none;
        }
        .admin-login-panel-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body class="admin-login">
    <aside class="admin-login-brand" aria-hidden="false">
        <div class="admin-login-brand-inner">
            <p class="admin-login-kicker">Content &amp; operations</p>
            <h1 class="admin-login-headline">Manage journeys, impact, and stories.</h1>
            <p class="admin-login-tagline">
                Sign in to update the site, publish trust articles, send invoices, and keep Halisi Africa Discoveries running smoothly.
            </p>
            <div class="admin-login-rule" aria-hidden="true"></div>
        </div>
        <p class="admin-login-brand-footer">
            <a href="{{ url('/') }}">&larr; Back to {{ $companyName }}</a>
        </p>
    </aside>

    <main class="admin-login-panel">
        <div class="admin-login-card">
            <header class="admin-login-card-header">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $companyName }}" class="admin-login-logo" width="200" height="52">
                @endif
                <h2 class="admin-login-card-title">Welcome back</h2>
                <p class="admin-login-card-sub">Sign in to the admin panel</p>
            </header>

            @if($errors->any())
                <div class="admin-login-alert" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <div>
                        @if($errors->has('email'))
                            {{ $errors->first('email') }}
                        @else
                            {{ $errors->first() }}
                        @endif
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="admin-login-form" novalidate>
                @csrf

                <div class="admin-login-field">
                    <label for="email" class="admin-login-label">Email address</label>
                    <div class="admin-login-input-wrap">
                        <svg class="admin-login-input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="you@example.com"
                            class="admin-login-input"
                        >
                    </div>
                </div>

                <div class="admin-login-field">
                    <label for="password" class="admin-login-label">Password</label>
                    <div class="admin-login-input-wrap">
                        <svg class="admin-login-input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="admin-login-input admin-login-input--password"
                        >
                        <button type="button" class="admin-login-toggle-pw" id="toggle-password" aria-label="Show password" aria-pressed="false">
                            <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="admin-login-row">
                    <label class="admin-login-remember">
                        <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="admin-login-submit">Sign in</button>
            </form>

            <p class="admin-login-panel-footer">
                <a href="{{ url('/') }}">View public website</a>
            </p>
        </div>
    </main>

    <script>
        (function () {
            var input = document.getElementById('password');
            var btn = document.getElementById('toggle-password');
            if (!input || !btn) return;

            btn.addEventListener('click', function () {
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                btn.setAttribute('aria-pressed', show ? 'true' : 'false');
                btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            });
        })();
    </script>
</body>
</html>

