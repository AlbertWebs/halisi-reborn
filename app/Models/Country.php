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
        'signature_card_1_label',
        'signature_card_1_image',
        'signature_card_1_video',
        'signature_card_2_label',
        'signature_card_2_image',
        'signature_card_2_video',
        'signature_card_3_label',
        'signature_card_3_image',
        'signature_card_3_video',
        'signature_card_4_label',
        'signature_card_4_image',
        'signature_card_4_video',
        'conservation_focus',
        'conservation_title',
        'conservation_visual_text',
        'conservation_image',
        'conservation_button_text',
        'conservation_button_link',
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
