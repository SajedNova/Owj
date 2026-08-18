<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMembers extends Model
{
    use HasFactory;

    protected $table = 'team_members';

    protected $fillable = [
        'name',
        'slug',
        'avatar',
        'bio',
        'role',
        'skills',
        'experience',
        'name_en',
        'slug_en',
        'role_en',
        'experience_en',
        'bio_en',
    ];


    public function portfolios()
    {
        return $this->belongsToMany(Portfolios::class, 'portfolio_team_member', 'team_member_id', 'portfolio_id')->withTimestamps();
    }
    protected function skills(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $decoded = json_decode($value, true);
                if (is_array($decoded)) {
                    return $decoded;
                }
                return $value ? array_filter(array_map('trim', explode(',', $value))) : [];
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
