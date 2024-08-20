<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        DB::table('competitions')->insert([
            [
                'competition_name' => 'National Championship',
                'competition_year' => 2025,
                'available_languages' => json_encode(['English', 'French', 'Spanish']),
                'maximum_points' => 100,
            ],
            [
                'competition_name' => 'Regional Qualifiers',
                'competition_year' => 2023,
                'available_languages' => json_encode(['English', 'German']),
                'maximum_points' => 75,
            ],
            [
                'competition_name' => 'International Open',
                'competition_year' => 2024,
                'available_languages' => json_encode(['English', 'French', 'Italian']),
                'maximum_points' => 120,
            ],
        ]);
    }
}
