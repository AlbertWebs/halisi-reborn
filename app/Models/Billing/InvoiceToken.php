<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class InvoiceToken extends Model
{
    protected $table = 'billing_invoice_tokens';

    protected $fillable = ['invoice_id', 'token', 'expires_at'];

    protected $casts = ['expires_at' => 'datetime'];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function isValid(): bool
    {
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }
        return true;
    }

    public static function generateFor(Invoice $invoice, ?\DateTimeInterface $expiresAt = null): self
    {
        return self::create([
            'invoice_id' => $invoice->id,
            'token' => Str::random(48),
            'expires_at' => $expiresAt,
        ]);
    }
}
