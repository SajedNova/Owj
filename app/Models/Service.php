<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'description',
        'description_en',
        'order',
    ];
}
