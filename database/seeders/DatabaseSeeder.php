<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(HeroSectionSeeder::class);
        $this->call(AboutSectionSeeder::class);
        $this->call(SiteSettingSeeder::class);
        $this->call(PortfolioSeeder::class);
        $this->call(TeamMemberSeeder::class);
        $this->call(AchievementSeeder::class);
        $this->call(TechnologySeeder::class);
    }
}
