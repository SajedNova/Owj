<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Portfolios;
use App\Models\TeamMembers;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolios = [
            [
                'title'                 => 'داشبورد کلاود',
                'title_en'              => 'Cloud Dashboard',
                'short_description'     => 'مانیتورینگ لحظه‌ای زیرساخت، ساخته‌شده برای مقیاس بزرگ',
                'short_description_en'  => 'Real-time infrastructure monitoring built for scale',
                'description'           => 'یک داشبورد جامع برای مانیتورینگ زیرساخت که امکان مشاهده لحظه‌ای وضعیت سرورها، هشدارهای هوشمند و گزارش‌های عملکردی را فراهم می‌کند. این پروژه با تمرکز بر مقیاس‌پذیری بالا و تاخیر پایین طراحی و پیاده‌سازی شد.',
                'description_en'        => 'A comprehensive infrastructure monitoring dashboard offering real-time server status, smart alerting, and performance reporting. Built with a focus on high scalability and low latency.',
                'client_name'           => 'شرکت نایت‌واچ',
                'client_name_en'        => 'Nightwatch Inc.',
                'project_url'           => 'https://example.com/cloud-dashboard',
                'duration'              => '۳ ماه',
                'duration_en'           => '3 months',
                'tools'                 => ['Laravel', 'Vue.js', 'Redis', 'Docker'],
                'category'              => 'application',
                'is_published'          => true,
                'images' => [
                    ['url' => 'https://picsum.photos/seed/owj01/1200/800', 'is_main' => true],
                    ['url' => 'https://picsum.photos/seed/owj01b/1200/800', 'is_main' => false],
                ],
                'team' => ['reza-ahmadi', 'sara-mohammadi'],
            ],
            [
                'title'                 => 'کیت کامپوننت OWJ',
                'title_en'              => 'OWJ Component Kit',
                'short_description'     => 'کتابخانه‌ای یکپارچه برای تولید سریع رابط‌ها',
                'short_description_en'  => 'A unified library for shipping interfaces fast',
                'description'           => 'یک سیستم طراحی و کتابخانه کامپوننت مشترک بین تیم‌های محصول که سرعت توسعه رابط کاربری را چند برابر کرد و یکپارچگی بصری بین محصولات مختلف را تضمین می‌کند.',
                'description_en'        => 'A shared design system and component library used across product teams, dramatically speeding up UI development while ensuring visual consistency across products.',
                'client_name'           => 'داخلی OWJcode',
                'client_name_en'        => 'OWJcode Internal',
                'project_url'           => 'https://example.com/owj-kit',
                'duration'              => '۲ ماه',
                'duration_en'           => '2 months',
                'tools'                 => ['Figma', 'React', 'Storybook', 'Tailwind CSS'],
                'category'              => 'website',
                'is_published'          => true,
                'images' => [
                    ['url' => 'https://picsum.photos/seed/owj02/1200/800', 'is_main' => true],
                ],
                'team' => ['ali-kazemi', 'zohreh-ghobour'],
            ],
            [
                'title'                 => 'نایت‌واچ آنالیتیکس',
                'title_en'              => 'Nightwatch Analytics',
                'short_description'     => 'ردیابی خطا و تحلیل عملکرد',
                'short_description_en'  => 'Error tracking and performance insight',
                'description'           => 'بازسازی کامل یک پلتفرم ردیابی خطا برای پشتیبانی از ۱۰ برابر ترافیک فعلی بدون افزودن سرور اضافه، همراه با بهبود ۴۰ درصدی تاخیر پاسخ‌دهی.',
                'description_en'        => 'A full rebuild of an error-tracking platform to support 10x current traffic without adding servers, alongside a 40% improvement in response latency.',
                'client_name'           => 'نایت‌واچ آنالیتیکس',
                'client_name_en'        => 'Nightwatch Analytics',
                'project_url'           => 'https://example.com/nightwatch-analytics',
                'duration'              => '۴ ماه',
                'duration_en'           => '4 months',
                'tools'                 => ['Laravel', 'PostgreSQL', 'Kafka', 'AWS'],
                'category'              => 'application',
                'is_published'          => true,
                'images' => [
                    ['url' => 'https://picsum.photos/seed/owj03/1200/800', 'is_main' => true],
                    ['url' => 'https://picsum.photos/seed/owj03b/1200/800', 'is_main' => false],
                ],
                'team' => ['reza-ahmadi', 'hossein-nouri'],
            ],
            [
                'title'                 => 'ابزارهای CLI آرتیزان',
                'title_en'              => 'Artisan CLI Tools',
                'short_description'     => 'ابزارهای توسعه که کارهای تکراری را خودکار می‌کنند',
                'short_description_en'  => 'Developer tooling that automates the boring parts',
                'description'           => 'مجموعه‌ای از دستورات Artisan متن‌باز برای خودکارسازی کارهای تکراری توسعه در پروژه‌های Laravel، از تولید کد تا استقرار.',
                'description_en'        => 'An open-source collection of Artisan commands that automate repetitive development tasks in Laravel projects, from code generation to deployment.',
                'client_name'           => 'متن‌باز',
                'client_name_en'        => 'Open Source',
                'project_url'           => 'https://github.com/owjcode/artisan-cli-tools',
                'duration'              => '۱ ماه',
                'duration_en'           => '1 month',
                'tools'                 => ['PHP', 'Laravel', 'Composer'],
                'category'              => 'application',
                'is_published'          => true,
                'images' => [
                    ['url' => 'https://picsum.photos/seed/owj04/1200/800', 'is_main' => true],
                ],
                'team' => ['ali-kazemi', 'maryam-hosseini'],
            ],
        ];

        foreach ($portfolios as $data) {
            $images = $data['images'];
            $teamSlugs = $data['team'];
            unset($data['images'], $data['team']);

            $slug = Str::slug($data['title_en']);
            $data['slug'] = $slug;
            $data['slug_en'] = $slug;

            $portfolio = Portfolios::updateOrCreate(
                ['slug' => $slug],
                $data
            );

            // Sync images
            $portfolio->images()->delete();
            foreach ($images as $image) {
                $portfolio->images()->create($image);
            }

            // Sync team members
            $teamIds = TeamMembers::whereIn('slug', $teamSlugs)->pluck('id');
            $portfolio->teamMembers()->sync($teamIds);
        }
    }
}
