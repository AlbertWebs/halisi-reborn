<?php

namespace App\Services\Billing;

use App\Models\Billing\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InvoicePdfService
{
    public function stream(Invoice $invoice)
    {
        $invoice->load(['client', 'items']);
        $companyName = \App\Models\SiteSetting::get('company_name', 'Halisi Africa Discoveries');
        $companyEmail = \App\Models\SiteSetting::get('company_email', '');
        $companyPhone = \App\Models\SiteSetting::get('company_phone', '');
        $companyAddress = \App\Models\SiteSetting::get('company_address', '');

        $pdf = Pdf::loadView('billing.pdf.invoice', [
            'invoice' => $invoice,
            'companyName' => $companyName,
            'companyEmail' => $companyEmail,
            'companyPhone' => $companyPhone,
            'companyAddress' => $companyAddress,
        ]);

        return $pdf->stream('invoice-' . $invoice->invoice_number . '.pdf');
    }

    public function download(Invoice $invoice)
    {
        $invoice->load(['client', 'items']);
        $companyName = \App\Models\SiteSetting::get('company_name', 'Halisi Africa Discoveries');
        $companyEmail = \App\Models\SiteSetting::get('company_email', '');
        $companyPhone = \App\Models\SiteSetting::get('company_phone', '');
        $companyAddress = \App\Models\SiteSetting::get('company_address', '');

        $pdf = Pdf::loadView('billing.pdf.invoice', [
            'invoice' => $invoice,
            'companyName' => $companyName,
            'companyEmail' => $companyEmail,
            'companyPhone' => $companyPhone,
            'companyAddress' => $companyAddress,
        ]);

        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }
}
