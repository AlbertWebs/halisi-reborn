<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Journey extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'hero_image',
        'narrative_intro',
        'experience_highlights',
        'regenerative_impact',
        'cta_label',
        'cta_link',
        'journey_category',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
