<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'description',
        'description_en',
        'image',
    ];
}
