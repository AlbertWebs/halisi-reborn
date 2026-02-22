<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'journey_id',
        'country_id',
        'ip_address',
        'user_agent',
    ];
}
