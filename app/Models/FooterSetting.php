<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'setting_key',
        'setting_type',
        'setting_value',
        'sort_order',
    ];
}
