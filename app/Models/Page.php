<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'hero_title',
        'hero_subtext',
        'body_content',
        'meta_title',
        'meta_description',
        'hero_image',
        'content_image_1',
        'content_image_2',
        'featured_label',
        'latest_articles_title',
        'latest_articles_description',
        'empty_state_message',
        'contact_section_title',
        'contact_section_intro',
        'contact_form_title',
        'contact_form_intro',
        'contact_form_button_label',
        'contact_map_embed_url',
        'contact_email_label',
        'contact_phone_label',
        'contact_address_label',
        'contact_hours_label',
        'contact_social_label',
        'is_published',
    ];

    /**
     * Extra content images (e.g. About page gallery). Ordered for display.
     */
    public function galleryImages(): HasMany
    {
        return $this->hasMany(PageImage::class)->orderBy('sort_order')->orderBy('id');
    }
}
