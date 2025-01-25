<?php

namespace Database\Seeders;

use App\Models\GagarinFlight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GagarinFlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаём сидер для заполнения БД данными (ну или можно заполнить данные вручную)
        GagarinFlight::create([
            'mission_name' => 'Восток 1',
            'launch_date' => '1961-04-12',
            'launch_site_name' => 'Космодром Байконур',
            'launch_site_latitude' => '45.9650000',
            'launch_site_longitude' => '63.3050000',
            'flight_duration_hours' => 1,
            'flight_duration_minutes' => 48,
            'spacecraft_name' => 'Восток 3KA',
            'spacecraft_manufacturer' => 'OKB-1',
            'spacecraft_crew_capacity' => 1,
            'landing_date' => '1961-04-12',
            'landing_site_name' => 'Смеловка',
            'landing_site_country' => 'СССР',
            'landing_site_latitude' => '51.2700000',
            'landing_site_longitude' => '45.9970000',
            'parachute_landing' => true,
            'impact_velocity_mps' => 7,
            'cosmonaut_name' => 'Юрий Гагарин',
            'cosmonaut_birthdate' => '1934-03-09',
            'cosmonaut_rank' => 'Старший лейтенант',
            'cosmonaut_bio_early_life' => 'Родился в Клушино, Россия.',
            'cosmonaut_bio_career' => 'Отобран в отряд космонавтов в 1960 году...',
            'cosmonaut_bio_post_flight' => 'Стал международным героем.',
        ]);
    }
}
