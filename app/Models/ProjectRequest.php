<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    use HasFactory;

    /**
     * فیلدهایی که مجاز به پر شدن دسته‌جمعی (mass assignment) هستند.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'message',
        'ip_address',
        'status',
    ];

    /**
     * وضعیت‌های ممکن برای یک درخواست پروژه.
     */
    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';
    public const STATUS_ARCHIVED = 'archived';
}
