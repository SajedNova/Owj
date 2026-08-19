<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\AboutSection::updateOrCreate(['id' => 1], [
            'title' => 'ساخته‌شده توسط مهندسانی که به جزئیات اهمیت می‌دهند',
            'title_en' => 'Built by engineers who care about the details',
            'description' => 'OWJcode یک استودیو مهندسی محصول است. ما با بنیان‌گذاران و تیم‌های در حال رشد همکاری می‌کنیم تا نرم‌افزاری طراحی، ساخته و منتشر کنیم که در استفاده واقعی دوام بیاورد.',
            'description_en' => 'OWJcode is a product engineering studio. We partner with founders and growing teams to design, build, and ship software that holds up under real usage.',
            'years_experience' => 8,
            'projects_shipped' => 120,
            'team_members' => 40,
        ]);
    }
}
