<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }} — {{ $companyName }}</title>
    <style>
        @page { margin: 36px 42px; }

        * { box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #2d2d2d;
            line-height: 1.45;
            margin: 0;
            padding: 0;
        }

        .accent-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 0 22px 0;
        }

        .accent-table td {
            padding: 0;
            height: 5px;
            line-height: 0;
            font-size: 0;
        }

        .accent-forest-cell { background: #1a4d3a; width: 72%; }
        .accent-gold-cell { background: #d4af37; width: 28%; }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 26px;
        }

        .header-table td {
            vertical-align: top;
            padding: 0;
        }

        .logo-wrap {
            width: 1%;
            padding-right: 18px;
        }

        .logo-wrap img {
            display: block;
            height: 52px;
            width: auto;
            max-width: 200px;
        }

        .brand-block {
            padding-top: 2px;
        }

        .brand-name {
            font-family: DejaVu Sans, sans-serif;
            font-size: 17px;
            font-weight: bold;
            color: #1a4d3a;
            letter-spacing: 0.02em;
            margin: 0 0 6px 0;
        }

        .brand-tagline {
            font-size: 8.5px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #6b7280;
            margin: 0 0 10px 0;
        }

        .brand-contact {
            font-size: 9.5px;
            color: #4b5563;
            line-height: 1.55;
        }

        .brand-contact a { color: #1a4d3a; text-decoration: none; }

        .invoice-panel {
            text-align: right;
            width: 38%;
        }

        .invoice-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.22em;
            color: #9ca3af;
            margin: 0 0 4px 0;
        }

        .invoice-number {
            font-size: 20px;
            font-weight: bold;
            color: #1a4d3a;
            margin: 0 0 12px 0;
            letter-spacing: 0.03em;
        }

        .status-pill {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .status-draft { background: #f3f4f6; color: #4b5563; }
        .status-sent { background: #eff6ff; color: #1d4ed8; }
        .status-paid { background: #ecfdf5; color: #047857; }
        .status-overdue { background: #fef2f2; color: #b91c1c; }

        .dates-row {
            margin-top: 10px;
            font-size: 9.5px;
            color: #6b7280;
        }

        .dates-row strong { color: #374151; }

        .section-title {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: #1a4d3a;
            font-weight: bold;
            margin: 0 0 8px 0;
            padding-bottom: 6px;
            border-bottom: 2px solid #e8efe9;
        }

        .bill-card {
            background: #fafbf9;
            border: 1px solid #e5ebe6;
            border-radius: 8px;
            padding: 16px 18px;
            margin-bottom: 24px;
        }

        .bill-card .client-name {
            font-size: 13px;
            font-weight: bold;
            color: #111827;
            margin: 0 0 8px 0;
        }

        .bill-card .client-lines {
            font-size: 10px;
            color: #4b5563;
            line-height: 1.6;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
            border-radius: 8px;
            overflow: hidden;
        }

        .items-table thead th {
            background: #1a4d3a;
            color: #fff;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-weight: bold;
            padding: 11px 12px;
            text-align: left;
        }

        .items-table thead th.text-right { text-align: right; }

        .items-table tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #eef1ef;
            font-size: 10px;
            vertical-align: top;
        }

        .items-table tbody tr:nth-child(even) td {
            background: #fafbf9;
        }

        .items-table tbody tr:last-child td {
            border-bottom: none;
        }

        .text-right { text-align: right; }

        .totals-wrap {
            margin-top: 8px;
            margin-left: auto;
            width: 100%;
            max-width: 280px;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
            background: #f4f7f4;
            border: 1px solid #dce6de;
            border-radius: 8px;
        }

        .totals-table td {
            padding: 8px 14px;
            font-size: 10px;
            border: none;
        }

        .totals-table .totals-label {
            color: #4b5563;
            text-align: right;
        }

        .totals-table .grand-row td {
            background: #1a4d3a;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 14px;
        }

        .totals-table .grand-row .totals-label {
            color: rgba(255, 255, 255, 0.92);
        }

        .gold-line {
            height: 2px;
            background: #d4af37;
            margin: 22px 0 16px 0;
            border-radius: 1px;
            opacity: 0.85;
        }

        .notes-box {
            margin-top: 18px;
            padding: 14px 16px;
            background: #faf9f6;
            border-left: 4px solid #d4af37;
            border-radius: 0 8px 8px 0;
            font-size: 10px;
            color: #374151;
        }

        .notes-box strong {
            display: block;
            color: #1a4d3a;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 6px;
        }

        .pay-box {
            margin-top: 14px;
            padding: 14px 16px;
            background: #f0f7f4;
            border: 1px solid #c5ddd0;
            border-radius: 8px;
            font-size: 10px;
            color: #1f2937;
        }

        .pay-box strong {
            color: #1a4d3a;
            font-size: 10px;
        }

        .footer {
            margin-top: 32px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 8.5px;
            color: #9ca3af;
            line-height: 1.6;
        }

        .footer-brand {
            color: #1a4d3a;
            font-weight: bold;
            font-size: 9px;
            letter-spacing: 0.06em;
        }
    </style>
</head>
<body>
    <table class="accent-table" role="presentation">
        <tr>
            <td class="accent-forest-cell">&nbsp;</td>
            <td class="accent-gold-cell">&nbsp;</td>
        </tr>
    </table>

    <table class="header-table">
        <tr>
            <td class="logo-wrap">
                @if(!empty($logoDataUri))
                    <img src="{{ $logoDataUri }}" alt="{{ $companyName }}">
                @else
                    <div class="brand-name" style="font-size: 22px;">{{ $companyName }}</div>
                @endif
            </td>
            <td class="brand-block">
                @if(!empty($logoDataUri))
                    <p class="brand-name">{{ $companyName }}</p>
                    <p class="brand-tagline">Curated Africa journeys</p>
                @endif
                <div class="brand-contact">
                    @if($companyAddress)<div>{{ $companyAddress }}</div>@endif
                    @if($companyPhone)<div>{{ $companyPhone }}</div>@endif
                    @if($companyEmail)<div>{{ $companyEmail }}</div>@endif
                    @if($companyWebsite)<div>{{ preg_replace('#^https?://#', '', $companyWebsite) }}</div>@endif
                </div>
            </td>
            <td class="invoice-panel">
                <p class="invoice-label">Invoice</p>
                <p class="invoice-number">{{ $invoice->invoice_number }}</p>
                @php
                    $statusClass = match ($invoice->status) {
                        \App\Models\Billing\Invoice::STATUS_PAID => 'status-paid',
                        \App\Models\Billing\Invoice::STATUS_OVERDUE => 'status-overdue',
                        \App\Models\Billing\Invoice::STATUS_SENT => 'status-sent',
                        default => 'status-draft',
                    };
                @endphp
                <span class="status-pill {{ $statusClass }}">{{ strtoupper($invoice->status) }}</span>
                <div class="dates-row">
                    <div><strong>Issued</strong> {{ $invoice->issue_date->format('d M Y') }}</div>
                    <div><strong>Due</strong> {{ $invoice->due_date->format('d M Y') }}</div>
                </div>
            </td>
        </tr>
    </table>

    <p class="section-title">Bill to</p>
    <div class="bill-card">
        <p class="client-name">{{ $invoice->client->name }}</p>
        <div class="client-lines">
            {{ $invoice->client->email }}<br>
            @if($invoice->client->phone){{ $invoice->client->phone }}<br>@endif
            @if($invoice->client->company){{ $invoice->client->company }}<br>@endif
            @if($invoice->client->address){{ $invoice->client->address }}<br>@endif
            @if($invoice->client->city || $invoice->client->country)
                {{ trim(implode(', ', array_filter([$invoice->client->city, $invoice->client->postal_code, $invoice->client->country]))) }}
            @endif
        </div>
    </div>

    <p class="section-title">Line items</p>
    <table class="items-table">
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-right" style="width: 12%;">Qty</th>
                <th class="text-right" style="width: 20%;">Unit price</th>
                <th class="text-right" style="width: 20%;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->description }}@if($item->unit) <span style="color:#6b7280;">({{ $item->unit }})</span>@endif</td>
                    <td class="text-right">{{ number_format($item->quantity, 2) }}</td>
                    <td class="text-right">{{ $invoice->currency }} {{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right"><strong>{{ $invoice->currency }} {{ number_format($item->total, 2) }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals-wrap">
        <table class="totals-table">
            <tr>
                <td class="totals-label">Subtotal</td>
                <td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->subtotal, 2) }}</td>
            </tr>
            @if((float) $invoice->tax_amount > 0)
                <tr>
                    <td class="totals-label">Tax ({{ $invoice->tax_rate }}%)</td>
                    <td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->tax_amount, 2) }}</td>
                </tr>
            @endif
            @if((float) $invoice->discount_amount > 0)
                <tr>
                    <td class="totals-label">Discount</td>
                    <td class="text-right">− {{ $invoice->currency }} {{ number_format($invoice->discount_amount, 2) }}</td>
                </tr>
            @endif
            <tr class="grand-row">
                <td class="totals-label">Amount due</td>
                <td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->total, 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="gold-line"></div>

    @if($invoice->notes)
        <div class="notes-box">
            <strong>Notes</strong>
            {!! nl2br(e($invoice->notes)) !!}
        </div>
    @endif

    @if($invoice->payment_instructions)
        <div class="pay-box">
            <strong>Payment instructions</strong><br><br>
            {!! nl2br(e($invoice->payment_instructions)) !!}
        </div>
    @endif

    <div class="footer">
        <span class="footer-brand">{{ $companyName }}</span><br>
        Thank you for travelling with purpose. This document was generated electronically and is valid without a signature.<br>
        @if($companyEmail) {{ $companyEmail }} · @endif @if($companyWebsite) {{ $companyWebsite }} @endif
    </div>
</body>
</html>
