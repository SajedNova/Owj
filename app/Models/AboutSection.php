<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'description',
        'description_en',
        'years_experience',
        'projects_shipped',
        'team_members',
        'image',
    ];
}
