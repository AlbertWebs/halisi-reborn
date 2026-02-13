<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactStat extends Model
{
    protected $fillable = [
        'stat_key',
        'label',
        'value',
        'suffix',
        'description',
        'icon',
        'sort_order',
        'is_active',
    ];
}
