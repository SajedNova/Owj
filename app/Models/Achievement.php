<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'title_en',
        'description',
        'description_en',
        'order',
    ];
}
