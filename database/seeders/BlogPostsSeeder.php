<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogPostsSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title_fa' => 'آموزش لاراول ۱۰',
                'title_en' => 'Learning Laravel 10',
                'slug' => 'learning-laravel-10',
                'category_fa' => 'توسعه',
                'category_en' => 'Development',
                'excerpt_fa' => 'مقدمه‌ای بر لاراول ۱۰',
                'excerpt_en' => 'Introduction to Laravel 10',
                'content_fa' => 'محتوای کامل آموزش لاراول ۱۰ به فارسی',
                'content_en' => 'Full content of learning Laravel 10 in English',
                'status' => Post::STATUS_PUBLISHED,
                'published_at' => now(),
            ],
            [
                'title_fa' => 'طراحی رابط کاربری مدرن',
                'title_en' => 'Modern UI Design',
                'slug' => 'modern-ui-design',
                'category_fa' => 'طراحی',
                'category_en' => 'Design',
                'excerpt_fa' => 'اصول طراحی مدرن',
                'excerpt_en' => 'Principles of modern design',
                'content_fa' => 'محتوای کامل طراحی رابط کاربری به فارسی',
                'content_en' => 'Full content of Modern UI Design in English',
                'status' => Post::STATUS_PUBLISHED,
                'published_at' => now(),
            ],
            [
                'title_fa' => 'بهینه‌سازی دیتابیس',
                'title_en' => 'Database Optimization',
                'slug' => 'database-optimization',
                'category_fa' => 'کلاود',
                'category_en' => 'Cloud',
                'excerpt_fa' => 'راهکارهای بهینه‌سازی دیتابیس',
                'excerpt_en' => 'Strategies for database optimization',
                'content_fa' => 'محتوای کامل بهینه‌سازی دیتابیس به فارسی',
                'content_en' => 'Full content of Database Optimization in English',
                'status' => Post::STATUS_PUBLISHED,
                'published_at' => now(),
            ],
            [
                'title_fa' => 'هوش مصنوعی در محصول',
                'title_en' => 'AI in Product',
                'slug' => 'ai-in-product',
                'category_fa' => 'علم داده',
                'category_en' => 'Data Science',
                'excerpt_fa' => 'کاربرد هوش مصنوعی در محصولات',
                'excerpt_en' => 'Application of AI in products',
                'content_fa' => 'محتوای کامل هوش مصنوعی در محصول به فارسی',
                'content_en' => 'Full content of AI in Product in English',
                'status' => Post::STATUS_PUBLISHED,
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
