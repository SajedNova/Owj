<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'address',
        'address_en',
        'phone',
        'email',
        'twitter_url',
        'github_url',
        'instagram_url',
        'telegram_url',
    ];
}
