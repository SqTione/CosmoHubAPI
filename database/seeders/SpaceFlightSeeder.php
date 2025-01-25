<?php

namespace Database\Seeders;

use App\Models\SpaceFlight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpaceFlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SpaceFlight::create([
            'flight_number' => 'СФ-103',
            'destination' => 'Марс',
            'launch_date' => '2025-05-15',
            'seats_available' => 6,
        ]);
    }
}
