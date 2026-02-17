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
        'hero_video',
        'hero_subtitle',
        'narrative_image',
        'country_narrative',
        'signature_experiences',
        'signature_experiences_title',
        'conservation_focus',
        'conservation_title',
        'conservation_visual_text',
        'featured_journeys_title',
        'featured_journeys_button_text',
        'cta_label',
        'cta_link',
        'cta_title',
        'cta_description',
        'cta_button_text',
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
