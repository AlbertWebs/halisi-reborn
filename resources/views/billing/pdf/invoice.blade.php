<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        .header { margin-bottom: 30px; border-bottom: 2px solid #1a3c34; padding-bottom: 15px; }
        .company { font-size: 18px; font-weight: bold; color: #1a3c34; }
        .meta { font-size: 10px; color: #666; margin-top: 5px; }
        .invoice-title { font-size: 24px; font-weight: bold; color: #1a3c34; margin-bottom: 20px; }
        .bill-to { margin-bottom: 25px; }
        .bill-to label { font-weight: bold; color: #555; display: block; margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #1a3c34; color: #fff; padding: 10px 8px; text-align: left; font-size: 11px; }
        td { padding: 8px; border-bottom: 1px solid #eee; }
        .text-right { text-align: right; }
        .totals { margin-top: 20px; max-width: 280px; margin-left: auto; }
        .totals tr td { border: none; padding: 4px 8px; }
        .totals .label { text-align: right; color: #555; }
        .totals .grand { font-size: 14px; font-weight: bold; color: #1a3c34; border-top: 2px solid #1a3c34; padding-top: 8px; }
        .notes { margin-top: 30px; padding: 15px; background: #f9f9f9; border-radius: 4px; font-size: 11px; }
        .payment-instructions { margin-top: 15px; padding: 15px; background: #f0f7f5; border-left: 4px solid #1a3c34; font-size: 11px; }
        .footer { margin-top: 40px; font-size: 10px; color: #888; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <div class="company">{{ $companyName }}</div>
        @if($companyEmail || $companyPhone || $companyAddress)
            <div class="meta">
                @if($companyEmail) {{ $companyEmail }} @endif
                @if($companyPhone) | {{ $companyPhone }} @endif
                @if($companyAddress) | {{ $companyAddress }} @endif
            </div>
        @endif
    </div>

    <div class="invoice-title">INVOICE {{ $invoice->invoice_number }}</div>

    <div class="bill-to">
        <label>Bill To</label>
        <strong>{{ $invoice->client->name }}</strong><br>
        {{ $invoice->client->email }}<br>
        @if($invoice->client->phone) {{ $invoice->client->phone }}<br> @endif
        @if($invoice->client->company) {{ $invoice->client->company }}<br> @endif
        @if($invoice->client->address) {{ $invoice->client->address }}<br> @endif
        @if($invoice->client->city || $invoice->client->country)
            {{ trim(implode(', ', array_filter([$invoice->client->city, $invoice->client->postal_code, $invoice->client->country]))) }}
        @endif
    </div>

    <table>
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
                    <td>{{ $item->description }} @if($item->unit) ({{ $item->unit }}) @endif</td>
                    <td class="text-right">{{ number_format($item->quantity, 2) }}</td>
                    <td class="text-right">{{ $invoice->currency }} {{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">{{ $invoice->currency }} {{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr><td class="label">Subtotal</td><td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->subtotal, 2) }}</td></tr>
        @if((float) $invoice->tax_amount > 0)
            <tr><td class="label">Tax ({{ $invoice->tax_rate }}%)</td><td class="text-right">{{ $invoice->currency }} {{ number_format($invoice->tax_amount, 2) }}</td></tr>
        @endif
        @if((float) $invoice->discount_amount > 0)
            <tr><td class="label">Discount</td><td class="text-right">- {{ $invoice->currency }} {{ number_format($invoice->discount_amount, 2) }}</td></tr>
        @endif
        <tr><td class="label grand">Amount Due</td><td class="text-right grand">{{ $invoice->currency }} {{ number_format($invoice->total, 2) }}</td></tr>
    </table>

    <p><strong>Issue date:</strong> {{ $invoice->issue_date->format('d M Y') }} &nbsp; <strong>Due date:</strong> {{ $invoice->due_date->format('d M Y') }}</p>

    @if($invoice->notes)
        <div class="notes">{!! nl2br(e($invoice->notes)) !!}</div>
    @endif

    @if($invoice->payment_instructions)
        <div class="payment-instructions"><strong>Payment instructions</strong><br>{!! nl2br(e($invoice->payment_instructions)) !!}</div>
    @endif

    <div class="footer" style="margin-top: 40px;">
        Thank you for your business. This is a computer-generated invoice.
    </div>
</body>
</html>
