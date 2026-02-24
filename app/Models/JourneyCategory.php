<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JourneyCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function journeys(): HasMany
    {
        return $this->hasMany(Journey::class, 'journey_category_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
