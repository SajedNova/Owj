<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioImages extends Model
{
    use HasFactory;

    protected $table = 'portfolio_images';

    protected $fillable = [
        'url',
        'is_main',
        'portfolio_id',
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolios::class, 'portfolio_id');
    }
}
