@php
    $companyName = \App\Models\SiteSetting::get('company_name', 'Halisi Africa Discoveries');
    $logo = \App\Models\SiteSetting::get('logo_main') ?: \App\Models\SiteSetting::get('logo_footer');
    $logoUrl = $logo ? asset('storage/' . $logo) : null;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice {{ $invoice->invoice_number }} – {{ $companyName }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --inv-green: #1a4d3a;
            --inv-green-light: #2d6b4a;
            --inv-gold: #d4af37;
            --inv-sand: #e8dcc4;
            --inv-offwhite: #faf9f6;
            --inv-muted: #6b4e3d;
            --inv-border: #e5e0d5;
        }
        body {
            font-family: 'Instrument Sans', system-ui, sans-serif;
            background: linear-gradient(180deg, var(--inv-offwhite) 0%, #f0ebe3 100%);
            color: #2d3748;
            min-height: 100vh;
            margin: 0;
        }
        .inv-container { max-width: 680px; margin: 0 auto; padding: 2rem 1.25rem 3rem; }
        .inv-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            flex-wrap: wrap;
            padding: 1.75rem 2rem;
            background: linear-gradient(135deg, var(--inv-green) 0%, var(--inv-green-light) 100%);
            border-radius: 12px 12px 0 0;
            color: #fff;
            box-shadow: 0 4px 6px -1px rgba(26, 77, 58, 0.15);
        }
        .inv-header-left { flex-shrink: 0; }
        .inv-header-right { text-align: right; }
        .inv-header-right .inv-company { margin-bottom: 0.15rem; }
        .inv-header-right .inv-badge { display: block; margin-top: 0.2rem; }
        .inv-logo {
            height: 48px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
            object-position: left;
        }
        .inv-company { font-family: 'Playfair Display', serif; font-size: 1.35rem; font-weight: 700; letter-spacing: 0.02em; }
        .inv-badge {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            opacity: 0.92;
        }
        .inv-card {
            background: #fff;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.06), 0 2px 4px -2px rgba(0,0,0,0.04);
            overflow: hidden;
            margin-bottom: 1.5rem;
            border: 1px solid var(--inv-border);
            border-top: none;
        }
        .inv-body { padding: 2rem 2rem 2.5rem; }
        .inv-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--inv-green);
            margin-bottom: 0.25rem;
        }
        .inv-meta { font-size: 0.875rem; color: var(--inv-muted); margin-bottom: 1.75rem; }
        .inv-billto {
            padding: 1.25rem 1.5rem;
            background: var(--inv-offwhite);
            border-radius: 10px;
            border-left: 4px solid var(--inv-gold);
            margin-bottom: 1.75rem;
        }
        .inv-billto strong { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--inv-muted); display: block; margin-bottom: 0.5rem; }
        .inv-billto .name { font-weight: 600; color: #1a202c; }
        .inv-billto div { font-size: 0.9rem; color: #4a5568; line-height: 1.5; }
        .inv-table-wrap { overflow-x: auto; margin: 1.5rem 0; border: 1px solid var(--inv-border); border-radius: 10px; }
        .inv-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        .inv-table thead { background: var(--inv-green); color: #fff; }
        .inv-table th { text-align: left; padding: 0.75rem 1rem; font-weight: 600; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; }
        .inv-table th.text-right { text-align: right; }
        .inv-table td { padding: 0.875rem 1rem; border-bottom: 1px solid #f3f0eb; }
        .inv-table tbody tr:last-child td { border-bottom: none; }
        .inv-table .text-right { text-align: right; }
        .inv-table tbody tr:hover { background: #fafaf8; }
        .inv-totals {
            margin-top: 1.5rem;
            margin-left: auto;
            width: 260px;
            font-size: 0.9rem;
        }
        .inv-totals tr td { padding: 0.4rem 0; border: none; }
        .inv-totals .label { text-align: right; color: var(--inv-muted); padding-right: 1rem; }
        .inv-totals .grand { font-size: 1.15rem; font-weight: 700; color: var(--inv-green); border-top: 2px solid var(--inv-gold); padding-top: 0.6rem; margin-top: 0.25rem; }
        .inv-amount-due {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--inv-green);
            margin: 1.5rem 0 1rem;
            padding: 1rem 1.25rem;
            background: linear-gradient(135deg, rgba(26,77,58,0.06) 0%, rgba(212,175,55,0.08) 100%);
            border-radius: 10px;
            border-left: 4px solid var(--inv-gold);
        }
        .inv-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 1.75rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .inv-btn:hover { transform: translateY(-1px); }
        .inv-btn-primary {
            background: var(--inv-green);
            color: #fff;
            box-shadow: 0 2px 8px rgba(26,77,58,0.3);
        }
        .inv-btn-primary:hover { box-shadow: 0 4px 12px rgba(26,77,58,0.35); }
        .inv-btn-secondary {
            background: #fff;
            color: var(--inv-green);
            border: 2px solid var(--inv-green);
        }
        .inv-btn-secondary:hover { background: var(--inv-offwhite); }
        .inv-actions { display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 1.25rem; align-items: center; }
        .inv-instructions {
            margin-top: 1.75rem;
            padding: 1.25rem 1.5rem;
            background: #f8f6f2;
            border-radius: 10px;
            font-size: 0.875rem;
            color: var(--inv-muted);
            line-height: 1.6;
        }
        .inv-instructions strong { color: var(--inv-green); }
        .inv-alert {
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        .inv-alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .inv-alert-info { background: #dbeafe; color: #1e40af; border: 1px solid #93c5fd; }
        .inv-alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .inv-footer { text-align: center; font-size: 0.8rem; color: var(--inv-muted); margin-top: 2rem; }
    </style>
</head>
<body>
    <div class="inv-container">
        @if(session('success'))
            <div class="inv-alert inv-alert-success">{{ session('success') }}</div>
        @endif
        @if(session('info'))
            <div class="inv-alert inv-alert-info">{{ session('info') }}</div>
        @endif
        @if(session('error'))
            <div class="inv-alert inv-alert-error">{{ session('error') }}</div>
        @endif

        <div class="inv-card">
            <header class="inv-header">
                <div class="inv-header-left">
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ $companyName }}" class="inv-logo">
                    @endif
                </div>
                <div class="inv-header-right">
                    <div class="inv-company">{{ $companyName }}</div>
                    <span class="inv-badge">Invoice</span>
                    <div class="inv-badge">{{ $invoice->invoice_number }}</div>
                </div>
            </header>

            <div class="inv-body">
                <h1 class="inv-title">Invoice {{ $invoice->invoice_number }}</h1>
                <p class="inv-meta">Issue date: {{ $invoice->issue_date->format('d M Y') }} · Due date: {{ $invoice->due_date->format('d M Y') }}</p>

                <div class="inv-billto">
                    <strong>Bill to</strong>
                    <div class="name">{{ $invoice->client->name }}</div>
                    <div>{{ $invoice->client->email }}</div>
                    @if($invoice->client->phone)<div>{{ $invoice->client->phone }}</div>@endif
                    @if($invoice->client->company)<div>{{ $invoice->client->company }}</div>@endif
                </div>

                <div class="inv-table-wrap">
                    <table class="inv-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Unit Price</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->items as $item)
                                <tr>
                                    <td>{{ $item->description }} @if($item->unit)<span style="color: var(--inv-muted);">({{ $item->unit }})</span>@endif</td>
                                    <td class="text-right">{{ number_format($item->quantity, 2) }}</td>
                                    <td class="text-right">{{ $invoice->currency }} {{ number_format($item->unit_price, 2) }}</td>
                                    <td class="text-right">{{ $invoice->currency }} {{ number_format($item->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <table class="inv-totals">
                    <tr><td class="label">Subtotal</td><td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->subtotal, 2) }}</td></tr>
                    @if((float) $invoice->tax_amount > 0)
                        <tr><td class="label">Tax</td><td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->tax_amount, 2) }}</td></tr>
                    @endif
                    @if((float) $invoice->discount_amount > 0)
                        <tr><td class="label">Discount</td><td class="text-right">− {{ $invoice->currency }} {{ number_format($invoice->discount_amount, 2) }}</td></tr>
                    @endif
                    <tr><td class="label grand">Amount due</td><td class="text-right grand">{{ $invoice->currency }} {{ number_format($invoice->total, 2) }}</td></tr>
                </table>

                @php $amountDue = (float) $invoice->total - $invoice->totalPaid(); $isPaid = (isset($alreadyPaid) && $alreadyPaid) || $amountDue <= 0; @endphp
                @if($isPaid)
                    <p class="inv-amount-due">This invoice has been paid. Thank you.</p>
                    <div class="inv-actions">
                        <a href="{{ route('billing.invoice.pdf', $invoiceToken->token) }}" class="inv-btn inv-btn-secondary">Download PDF</a>
                    </div>
                @else
                    <p class="inv-amount-due">Amount due: {{ $invoice->currency }} {{ number_format($amountDue, 2) }}</p>
                    <div class="inv-actions">
                        <a href="{{ route('billing.invoice.pay', $invoiceToken->token) }}" class="inv-btn inv-btn-primary">Pay now</a>
                        <a href="{{ route('billing.invoice.pdf', $invoiceToken->token) }}" class="inv-btn inv-btn-secondary">Download PDF</a>
                    </div>
                @endif

                @if($invoice->payment_instructions)
                    <div class="inv-instructions">
                        <strong>Payment instructions</strong><br>
                        {!! nl2br(e($invoice->payment_instructions)) !!}
                    </div>
                @endif
            </div>
        </div>

        <p class="inv-footer">If you have any questions, please contact us.</p>
    </div>
</body>
</html>
