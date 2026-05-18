@php
    $companyName = \App\Models\SiteSetting::get('company_name', 'Halisi Africa Discoveries');
    $logo = \App\Models\SiteSetting::get('logo_main') ?: \App\Models\SiteSetting::get('logo_footer');
    $logoUrl = $logo ? asset('storage/' . $logo) : null;
    $currency = config('pesapal.currency', 'KES');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pay invoice {{ $invoice->invoice_number }} â€“ {{ $companyName }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --inv-green: #1a4d3a;
            --inv-gold: #d4af37;
            --inv-offwhite: #faf9f6;
            --inv-muted: #6b4e3d;
            --inv-border: #e5e0d5;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Instrument Sans', system-ui, sans-serif;
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--inv-offwhite) 0%, #f0ebe3 100%);
            color: #2d3748;
        }
        .pay-shell {
            max-width: 960px;
            margin: 0 auto;
            padding: 1.25rem 1rem 2rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .pay-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }
        .pay-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .pay-logo { height: 40px; width: auto; max-width: 160px; object-fit: contain; }
        .pay-brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--inv-green);
        }
        .pay-meta { font-size: 0.875rem; color: var(--inv-muted); }
        .pay-back {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--inv-green);
            text-decoration: none;
        }
        .pay-back:hover { text-decoration: underline; }
        .pay-card {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #fff;
            border: 1px solid var(--inv-border);
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(26, 77, 58, 0.08);
            overflow: hidden;
            min-height: min(78vh, 720px);
        }
        .pay-card-head {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--inv-border);
            background: linear-gradient(135deg, rgba(26, 77, 58, 0.06) 0%, rgba(212, 175, 55, 0.08) 100%);
        }
        .pay-card-head h1 {
            margin: 0 0 0.25rem;
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            color: var(--inv-green);
        }
        .pay-card-head p { margin: 0; font-size: 0.9rem; color: var(--inv-muted); }
        .pay-frame-wrap {
            position: relative;
            flex: 1;
            min-height: 520px;
            background: #f8f6f2;
        }
        .pay-frame-loader {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            color: var(--inv-muted);
            font-size: 0.9rem;
            z-index: 1;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .pay-frame-loader.is-hidden { opacity: 0; }
        .pay-spinner {
            width: 2rem;
            height: 2rem;
            border: 3px solid rgba(26, 77, 58, 0.15);
            border-top-color: var(--inv-green);
            border-radius: 50%;
            animation: paySpin 0.8s linear infinite;
        }
        @keyframes paySpin { to { transform: rotate(360deg); } }
        .pay-frame {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: 0;
            background: #fff;
        }
        .pay-secure {
            text-align: center;
            font-size: 0.75rem;
            color: var(--inv-muted);
            margin-top: 0.75rem;
        }
        @media (max-width: 640px) {
            .pay-card { min-height: calc(100vh - 5rem); }
            .pay-frame-wrap { min-height: calc(100vh - 11rem); }
        }
    </style>
</head>
<body>
    <div class="pay-shell">
        <header class="pay-top">
            <div class="pay-brand">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $companyName }}" class="pay-logo">
                @endif
                <span class="pay-brand-text">{{ $companyName }}</span>
            </div>
            <a href="{{ route('billing.invoice.show', $invoiceToken->token) }}" class="pay-back">&larr; Back to invoice</a>
        </header>

        <div class="pay-card">
            <div class="pay-card-head">
                <h1>Complete your payment</h1>
                <p>
                    Invoice {{ $invoice->invoice_number }} &middot;
                    {{ $currency }} {{ number_format($amountDue, 2) }} due
                </p>
            </div>
            <div class="pay-frame-wrap">
                <div id="pay-frame-loader" class="pay-frame-loader" aria-live="polite">
                    <span class="pay-spinner" aria-hidden="true"></span>
                    <span>Loading secure checkout&hellip;</span>
                </div>
                <iframe
                    id="pesapal-checkout-frame"
                    class="pay-frame"
                    src="{{ $pesapalUrl }}"
                    title="Pesapal secure payment"
                    allow="payment"
                    referrerpolicy="strict-origin-when-cross-origin"
                ></iframe>
            </div>
        </div>

        <p class="pay-secure">Payments are processed securely by Pesapal.</p>
    </div>

    <script>
        (function () {
            var frame = document.getElementById('pesapal-checkout-frame');
            var loader = document.getElementById('pay-frame-loader');
            if (!frame || !loader) return;

            function hideLoader() {
                loader.classList.add('is-hidden');
            }

            frame.addEventListener('load', hideLoader, { once: true });
            window.setTimeout(hideLoader, 8000);
        })();
    </script>
</body>
</html>

