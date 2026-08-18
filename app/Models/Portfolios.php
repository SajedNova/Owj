<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolios extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'is_published',
        'client_name',
        'project_url',
        'duration',
        'tools',
        'category',
        'title_en',
        'slug_en',
        'description_en',
        'short_description_en',
        'client_name_en',
        'duration_en',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function images()
    {
        return $this->hasMany(PortfolioImages::class, 'portfolio_id');
    }

    public function mainImage()
    {
        return $this->hasOne(PortfolioImages::class, 'portfolio_id')->where('is_main', true);
    }

    public function teamMembers()
    {
        return $this->belongsToMany(TeamMembers::class, 'portfolio_team_member', 'portfolio_id', 'team_member_id')->withTimestamps();
    }

    protected function tools(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $decoded = json_decode($value, true);
                return is_array($decoded) ? $decoded : [];
            },
            set: function ($value) {
                if (is_array($value)) {
                    return json_encode(array_values($value));
                }

                $decoded = json_decode($value, true);
                if (is_array($decoded)) {
                    return json_encode(array_values($decoded));
                }

                return json_encode(array_filter(array_map('trim', explode(',', (string) $value))));
            }
        );
    }
}
