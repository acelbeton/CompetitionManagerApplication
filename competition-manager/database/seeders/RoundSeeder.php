<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rounds')->insert([
            [
                'competition_id' => 1,
                'round_number' => 1,
                'location' => 'New York',
                'date' => '2024-05-01',
            ],
            [
                'competition_id' => 1,
                'round_number' => 2,
                'location' => 'Los Angeles',
                'date' => '2024-06-01',
            ],
            [
                'competition_id' => 2,
                'round_number' => 1,
                'location' => 'Berlin',
                'date' => '2023-03-15',
            ],
            [
                'competition_id' => 3,
                'round_number' => 1,
                'location' => 'Paris',
                'date' => '2024-07-10',
            ],
        ]);
    }
}
