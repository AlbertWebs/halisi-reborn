<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JourneyItinerary extends Model
{
    protected $fillable = [
        'journey_id',
        'day',
        'title',
        'content',
        'sort_order',
    ];

    protected $casts = [
        'day' => 'integer',
        'sort_order' => 'integer',
    ];

    public function journey(): BelongsTo
    {
        return $this->belongsTo(Journey::class);
    }
}
