<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\HeroSection::updateOrCreate(['id' => 1], [
            'title' => 'اوج‌کد — هوشمندانه بسازید، سریع‌تر منتشر کنید',
            'title_en' => 'OWJcode — Build Smarter, Ship Faster',
            'description' => 'ما وب‌سایت‌ها، اپلیکیشن‌های وب و موبایل سفارشی طراحی و توسعه می‌دهیم که سریع، امن و مقیاس‌پذیر هستند. از استارتاپ‌ها تا سازمان‌های بزرگ — ایده شما را به واقعیت تبدیل می‌کنیم.',
            'description_en' => 'We design and develop custom websites, web applications, and mobile apps that are fast, secure, and built to scale. From startups to enterprises — we turn your vision into reality.',
        ]);
    }
}
