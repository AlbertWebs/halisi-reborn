<?php

namespace App\Services\Billing;

use App\Models\Billing\Invoice;
use App\Models\SiteSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class InvoicePdfService
{
    public function stream(Invoice $invoice)
    {
        $pdf = Pdf::loadView('billing.pdf.invoice', $this->viewData($invoice))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('invoice-'.$invoice->invoice_number.'.pdf');
    }

    public function download(Invoice $invoice)
    {
        $pdf = Pdf::loadView('billing.pdf.invoice', $this->viewData($invoice))
            ->setPaper('a4', 'portrait');

        return $pdf->download('invoice-'.$invoice->invoice_number.'.pdf');
    }

    /**
     * @return array<string, mixed>
     */
    protected function viewData(Invoice $invoice): array
    {
        $invoice->load(['client', 'items']);

        return [
            'invoice' => $invoice,
            'companyName' => SiteSetting::get('company_name', 'Halisi Africa Discoveries'),
            'companyEmail' => SiteSetting::get('company_email', ''),
            'companyPhone' => SiteSetting::get('company_phone', ''),
            'companyAddress' => SiteSetting::get('company_address', ''),
            'companyWebsite' => SiteSetting::get('company_website', ''),
            'logoDataUri' => $this->resolveLogoDataUri(),
        ];
    }

    /**
     * Embed logo for DomPDF (data URI). Prefers admin-uploaded logos, then branded default SVG.
     */
    protected function resolveLogoDataUri(): ?string
    {
        $relativePaths = array_filter([
            SiteSetting::get('logo_main'),
            SiteSetting::get('logo_footer'),
        ], fn ($v) => filled($v) && ! Str::startsWith($v, ['http://', 'https://', 'data:']));

        $absolutePaths = [];
        foreach ($relativePaths as $rel) {
            $absolutePaths[] = storage_path('app/public/'.ltrim($rel, '/'));
        }
        $absolutePaths[] = public_path('images/invoice-logo-default.svg');
        $absolutePaths[] = public_path('images/logo-main.svg');

        foreach ($absolutePaths as $path) {
            if (! is_file($path)) {
                continue;
            }
            $raw = @file_get_contents($path);
            if ($raw === false || $raw === '') {
                continue;
            }
            $mime = $this->guessMime($path);

            return 'data:'.$mime.';base64,'.base64_encode($raw);
        }

        return null;
    }

    protected function guessMime(string $path): string
    {
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return match ($ext) {
            'svg' => 'image/svg+xml',
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            default => @mime_content_type($path) ?: 'image/png',
        };
    }
}
