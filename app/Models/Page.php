<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'is_published',
    ];
}
