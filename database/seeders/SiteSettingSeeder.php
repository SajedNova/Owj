<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SiteSetting::updateOrCreate(['id' => 1], [
            'email' => 'hello@owjcode.com',
            'phone' => '+1 (555) 012-3456',
            'address' => 'خیابان استودیو ۱۲۳، واحد ۴۰۰',
            'address_en' => '123 Studio Ave, Suite 400',
            'twitter_url' => 'https://twitter.com/owjcode',
            'github_url' => 'https://github.com/owjcode',
            'instagram_url' => 'https://instagram.com/owjcode',
            'telegram_url' => 'https://t.me/owjcode',
        ]);
    }
}
