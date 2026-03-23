<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'destination_brief_lead',
        'destination_brief_capital',
        'destination_brief_currency',
        'destination_brief_languages',
        'destination_brief_time_zone',
        'destination_brief_airports',
        'destination_brief_best_for',
        'destination_brief_ideal_trip_length',
        'destination_brief_best_time',
        'destination_brief_travel_style',
        'destination_brief_ecosystems',
        'destination_brief_entry_requirements',
        'destination_brief_health_notes',
        'destination_brief_climate_intro',
        'destination_brief_climate_1_season',
        'destination_brief_climate_1_note',
        'destination_brief_climate_2_season',
        'destination_brief_climate_2_note',
        'destination_brief_climate_3_season',
        'destination_brief_climate_3_note',
        'highlights_title',
        'highlight_1_title',
        'highlight_1_text',
        'highlight_1_image',
        'highlight_2_title',
        'highlight_2_text',
        'highlight_2_image',
        'highlight_3_title',
        'highlight_3_text',
        'highlight_3_image',
        'highlight_4_title',
        'highlight_4_text',
        'highlight_4_image',
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

    public function highlights(): HasMany
    {
        return $this->hasMany(CountryHighlight::class)->orderBy('sort_order')->orderBy('id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
