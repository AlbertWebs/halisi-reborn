<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'hero_image',
        'country_narrative',
        'signature_experiences',
        'conservation_focus',
        'cta_label',
        'cta_link',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function journeys(): BelongsToMany
    {
        return $this->belongsToMany(Journey::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
