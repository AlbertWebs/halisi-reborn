<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HeroCarouselSlide extends Model
{
    protected $fillable = [
        'sort_order',
        'image',
        'image_alt',
        'overlay_title',
        'overlay_subtitle',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function imageUrl(): string
    {
        return asset('storage/'.ltrim($this->image, '/'));
    }
}
