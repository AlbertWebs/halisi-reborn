<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $table = 'billing_invoices';

    public const STATUS_DRAFT = 'draft';
    public const STATUS_SENT = 'sent';
    public const STATUS_PAID = 'paid';
    public const STATUS_OVERDUE = 'overdue';

    protected $fillable = [
        'client_id',
        'invoice_number',
        'issue_date',
        'due_date',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'discount_type',
        'discount_value',
        'discount_amount',
        'total',
        'currency',
        'status',
        'notes',
        'payment_instructions',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_type' => 'decimal:2',
        'discount_value' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class)->orderBy('sort_order');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class)->orderByDesc('paid_at');
    }

    public function tokens(): HasMany
    {
        return $this->hasMany(InvoiceToken::class);
    }

    public function recalculateTotals(): void
    {
        $subtotal = $this->items->sum('total');
        $taxAmount = round($subtotal * ((float) $this->tax_rate / 100), 2);
        $discountAmount = 0;
        if ((float) $this->discount_value > 0) {
            $discountAmount = (float) $this->discount_type === 0
                ? (float) $this->discount_value
                : round($subtotal * ((float) $this->discount_value / 100), 2);
        }
        $this->subtotal = $subtotal;
        $this->tax_amount = $taxAmount;
        $this->discount_amount = $discountAmount;
        $this->total = round($subtotal + $taxAmount - $discountAmount, 2);
        $this->saveQuietly();
    }

    public function totalPaid(): float
    {
        return (float) $this->payments()->where('status', 'completed')->sum('amount');
    }

    public function isFullyPaid(): bool
    {
        return $this->totalPaid() >= (float) $this->total;
    }
}
