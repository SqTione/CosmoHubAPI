<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Заполняем БД информацией о полётах
        Flight::create([
            'name' => 'Аполлон-11',
            'crew_capacity' => 3,
            'launch_date' => '1969-07-16',
            'launch_site_name' => 'Космический центр имени Кеннеди',
            'launch_latitude' => '28.5721000',
            'launch_longitude' => '-80.6480000',
            'landing_date' => '1969-07-20',
            'landing_site_name' => 'Море спокойствия',
            'landing_latitude' => '0.6740000',
            'landing_longitude' => '23.4720000',
        ]);
    }
}
