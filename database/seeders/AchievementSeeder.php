<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            [
                'icon' => '🏆',
                'title' => 'برترین آژانس ۲۰۲۵',
                'title_en' => 'Top Agency 2025',
                'description' => 'شناخته‌شده در میان برترین استودیوهای توسعه منطقه.',
                'description_en' => "Recognized among the region's leading dev studios.",
                'order' => 1,
            ],
            [
                'icon' => '🚀',
                'title' => 'بیش از ۱۲۰ انتشار',
                'title_en' => '120+ Launches',
                'description' => 'محصولات منتشرشده در صنایع مختلف.',
                'description_en' => 'Products shipped to production across industries.',
                'order' => 2,
            ],
            [
                'icon' => '🔒',
                'title' => 'ISO 27001',
                'title_en' => 'ISO 27001',
                'description' => 'دارای گواهی مدیریت امنیت اطلاعات.',
                'description_en' => 'Certified for information security management.',
                'order' => 3,
            ],
            [
                'icon' => '⭐',
                'title' => 'امتیاز ۴.۹ از ۵',
                'title_en' => '4.9/5 Rating',
                'description' => 'میانگین امتیاز مشتریان در پروژه‌های تکمیل‌شده.',
                'description_en' => 'Average client rating across completed projects.',
                'order' => 4,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}
