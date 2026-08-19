<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        $technologies = [
            ['icon' => '⚛️', 'name' => 'React', 'order' => 1],
            ['icon' => '🟢', 'name' => 'Node.js', 'order' => 2],
            ['icon' => '🐘', 'name' => 'Laravel', 'order' => 3],
            ['icon' => '🐍', 'name' => 'Python', 'order' => 4],
            ['icon' => '☁️', 'name' => 'AWS', 'order' => 5],
            ['icon' => '🐳', 'name' => 'Docker', 'order' => 6],
        ];

        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}
