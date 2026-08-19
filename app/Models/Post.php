<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'title_fa',
        'title_en',
        'slug',
        'category_fa',
        'category_en',
        'excerpt_fa',
        'excerpt_en',
        'content_fa',
        'content_en',
        'image',
        'status',
        'user_id',
        'views',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $baseTitle = $post->title_fa ?: $post->title_en;
                $post->slug = static::generateUniqueSlug($baseTitle);
            }

            if ($post->status === self::STATUS_PUBLISHED && empty($post->published_at)) {
                $post->published_at = now();
            }
        });

        static::updating(function (Post $post) {
            if ($post->isDirty('status') && $post->status === self::STATUS_PUBLISHED && empty($post->published_at)) {
                $post->published_at = now();
            }
        });
    }

    public static function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        // fallback for non-latin titles (e.g. Persian) that slugify to empty string
        if (empty($slug)) {
            $slug = 'post-' . Str::random(8);
        }

        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    /*
    |--------------------------------------------------------------------
    | Bilingual helpers
    |--------------------------------------------------------------------
    | هر متد یک $locale اختیاری می‌گیرد (fa یا en). اگر پاس داده نشود
    | زبان فعلی سایت (app()->getLocale()) استفاده می‌شود و اگر مقدار
    | آن زبان خالی بود، به فارسی برمی‌گردد (fallback).
    */

    public function title(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        return $locale === 'en'
            ? ($this->title_en ?: $this->title_fa)
            : $this->title_fa;
    }

    public function category(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        return $locale === 'en'
            ? ($this->category_en ?: $this->category_fa)
            : $this->category_fa;
    }

    public function excerpt(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        return $locale === 'en'
            ? ($this->excerpt_en ?: $this->excerpt_fa)
            : $this->excerpt_fa;
    }

    public function content(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        return $locale === 'en'
            ? ($this->content_en ?: $this->content_fa)
            : $this->content_fa;
    }

    /**
     * آیا نسخه انگلیسی این پست کامل شده است؟ (برای نمایش نشان "EN" در ادمین)
     */
    public function hasEnglishVersion(): bool
    {
        return filled($this->title_en) && filled($this->content_en);
    }
}
