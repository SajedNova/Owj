<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'استراتژی محصول',
                'title_en' => 'Product Strategy',
                'description' => 'رودمپ، کشف نیازها و تعیین دامنه‌ای که ایده را به یک برنامه قابل‌اجرا تبدیل می‌کند.',
                'description_en' => 'Roadmaps, discovery, and scoping that turn an idea into a buildable plan.',
            ],
            [
                'title' => 'طراحی UI / UX',
                'title_en' => 'UI / UX Design',
                'description' => 'رابط‌هایی که بر اساس نحوه واقعی استفاده کاربران طراحی شده‌اند.',
                'description_en' => 'Interfaces designed around how people actually use the product.',
            ],
            [
                'title' => 'توسعه وب',
                'title_en' => 'Web Development',
                'description' => 'اپلیکیشن‌های وب سریع و قابل‌نگهداری بر پایه استک‌های مدرن و اثبات‌شده.',
                'description_en' => 'Fast, maintainable web apps built on modern, proven stacks.',
            ],
            [
                'title' => 'توسعه موبایل',
                'title_en' => 'Mobile Development',
                'description' => 'اپلیکیشن‌های نیتیو و کراس‌پلتفرم برای iOS و اندروید.',
                'description_en' => 'Native and cross-platform apps for iOS and Android.',
            ],
            [
                'title' => 'کلاود و DevOps',
                'title_en' => 'Cloud & DevOps',
                'description' => 'زیرساخت، CI/CD و دیپلوی‌هایی که بدون دردسر مقیاس می‌گیرند.',
                'description_en' => 'Infrastructure, CI/CD, and deployments that scale without drama.',
            ],
            [
                'title' => 'پشتیبانی مستمر',
                'title_en' => 'Ongoing Support',
                'description' => 'نگهداری، مانیتورینگ و بهبود مستمر پس از انتشار.',
                'description_en' => 'Maintenance, monitoring, and iteration after launch day.',
            ],
        ];
        foreach ($services as $service) {
            Service::create($service);
        }
    }

}
