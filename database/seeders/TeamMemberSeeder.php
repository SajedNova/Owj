<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\TeamMembers;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name'          => 'علی کاظمی',
                'name_en'       => 'Ali Kazemi',
                'avatar'        => 'https://i.pravatar.cc/300?img=12',
                'role'          => 'طراح رابط کاربری',
                'role_en'       => 'UI Designer',
                'bio'           => 'علی بیش از ۶ سال تجربه در طراحی رابط کاربری برای محصولات وب و موبایل دارد و روی جزئیات تعامل کاربر تمرکز می‌کند.',
                'bio_en'        => 'Ali has over 6 years of experience designing interfaces for web and mobile products, focused on the small details of user interaction.',
                'skills'        => ['Figma', 'UI Design', 'Prototyping', 'Design Systems'],
                'experience'    => '۶ سال',
                'experience_en' => '6 years',
            ],
            [
                'name'          => 'رضا احمدی',
                'name_en'       => 'Reza Ahmadi',
                'avatar'        => 'https://i.pravatar.cc/300?img=13',
                'role'          => 'توسعه‌دهنده بک‌اند',
                'role_en'       => 'Backend Engineer',
                'bio'           => 'رضا متخصص معماری سرویس‌های بک‌اند مقیاس‌پذیر است و روی Laravel و زیرساخت‌های کلاود کار می‌کند.',
                'bio_en'        => 'Reza specializes in scalable backend service architecture, working primarily with Laravel and cloud infrastructure.',
                'skills'        => ['PHP', 'Laravel', 'MySQL', 'Docker'],
                'experience'    => '۷ سال',
                'experience_en' => '7 years',
            ],
            [
                'name'          => 'زهره قبور',
                'name_en'       => 'Zohreh Ghobour',
                'avatar'        => 'https://i.pravatar.cc/300?img=45',
                'role'          => 'طراح رابط کاربری',
                'role_en'       => 'UI Designer',
                'bio'           => 'زهره در طراحی سیستم‌های طراحی و کامپوننت‌های قابل استفاده مجدد تخصص دارد.',
                'bio_en'        => 'Zohreh specializes in design systems and building reusable component libraries.',
                'skills'        => ['Figma', 'Design Systems', 'Illustration'],
                'experience'    => '۴ سال',
                'experience_en' => '4 years',
            ],
            [
                'name'          => 'سارا محمدی',
                'name_en'       => 'Sara Mohammadi',
                'avatar'        => 'https://i.pravatar.cc/300?img=51',
                'role'          => 'توسعه‌دهنده فرانت‌اند',
                'role_en'       => 'Frontend Engineer',
                'bio'           => 'سارا با تمرکز بر عملکرد و دسترس‌پذیری، رابط‌های کاربری واکنش‌گرا با React و Vue می‌سازد.',
                'bio_en'        => 'Sara builds responsive, accessible interfaces with React and Vue, with a strong focus on performance.',
                'skills'        => ['React', 'Vue', 'TypeScript', 'Tailwind CSS'],
                'experience'    => '۵ سال',
                'experience_en' => '5 years',
            ],
            [
                'name'          => 'حسین نوری',
                'name_en'       => 'Hossein Nouri',
                'avatar'        => 'https://i.pravatar.cc/300?img=33',
                'role'          => 'طراح گرافیک',
                'role_en'       => 'Graphic Designer',
                'bio'           => 'حسین هویت بصری برندها و محتوای گرافیکی کمپین‌های بازاریابی را طراحی می‌کند.',
                'bio_en'        => 'Hossein designs brand visual identities and graphic content for marketing campaigns.',
                'skills'        => ['Photoshop', 'Illustrator', 'Branding'],
                'experience'    => '۸ سال',
                'experience_en' => '8 years',
            ],
            [
                'name'          => 'مریم حسینی',
                'name_en'       => 'Maryam Hosseini',
                'avatar'        => 'https://i.pravatar.cc/300?img=47',
                'role'          => 'مدیر محصول',
                'role_en'       => 'Product Manager',
                'bio'           => 'مریم مسئول تعریف نقشه راه محصول و هماهنگی بین تیم‌های طراحی، توسعه و کسب‌وکار است.',
                'bio_en'        => 'Maryam owns the product roadmap and coordinates between design, engineering, and business teams.',
                'skills'        => ['Product Strategy', 'Roadmapping', 'Agile'],
                'experience'    => '۹ سال',
                'experience_en' => '9 years',
            ],
        ];

        foreach ($members as $member) {
            $slug = Str::slug($member['name_en']);

            TeamMembers::updateOrCreate(
                ['slug' => $slug],
                [
                    'name'          => $member['name'],
                    'name_en'       => $member['name_en'],
                    'slug'          => $slug,
                    'slug_en'       => $slug,
                    'avatar'        => $member['avatar'],
                    'bio'           => $member['bio'],
                    'bio_en'        => $member['bio_en'],
                    'role'          => $member['role'],
                    'role_en'       => $member['role_en'],
                    'skills'        => $member['skills'],
                    'experience'    => $member['experience'],
                    'experience_en' => $member['experience_en'],
                ]
            );
        }
    }
}
