<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Journey extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'journey_category_id',
        'hero_image',
        'hero_video',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(JourneyCategory::class, 'journey_category_id');
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class);
    }

    public function galleryImages(): HasMany
    {
        return $this->hasMany(JourneyImage::class)->orderBy('sort_order');
    }

    public function itineraryItems(): HasMany
    {
        return $this->hasMany(JourneyItinerary::class)->orderBy('day')->orderBy('sort_order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
