<?php

namespace App\Http\Controllers;

use App\Models\GagarinFlight;
use Illuminate\Http\Request;

class GagarinFlightController extends Controller
{
    // Функция для получения информации о полёте Гагарина
    public function index() {
        // Получаем данные из базы
        $flight = GagarinFlight::first();

        // Проверка наличия данных (в задании не предусмотрена)
        if (!$flight) {
            return response()->json([
                'error' => [
                    'code' => 404,
                    'message' => 'Gagarin`s Flight data not found',
                    'errors' => ['Gagarin`s Flight data not found'],
                ],
            ], 404);
        }

        // Формируем JSON по заданию
        $data = [
            'data' => [
                [
                    'mission' => [
                        'name' => $flight->mission_name,
                        'launch_details' => [
                            'launch_date' => $flight->launch_date,
                            'launch_site' => [
                                'name' => $flight->launch_site_name,
                                'location' => [
                                    'latitude' => $flight->launch_site_latitude,
                                    'longitude' => $flight->launch_site_longitude,
                                ],
                            ],
                        ],
                        'flight_duration' => [
                            'hours' => $flight->flight_duration_hours,
                            'minutes' => $flight->flight_duration_minutes,
                        ],
                        'spacecraft' => [
                            'name' => $flight->spacecraft_name,
                            'manufacturer' => $flight->spacecraft_manufacturer,
                            'crew_capacity' => $flight->spacecraft_crew_capacity,
                        ],
                    ],
                    'landing' => [
                        'date' => $flight->landing_date,
                        'site' => [
                            'name' => $flight->landing_site_name,
                            'country' => $flight->landing_site_country,
                            'coordinates' => [
                                'latitude' => $flight->landing_site_latitude,
                                'longitude' => $flight->landing_site_longitude,
                            ],
                        ],
                        'details' => [
                            'parachute_landing' => $flight->parachute_landing,
                            'impact_velocity_mps' => $flight->impact_velocity_mps,
                        ],
                    ],
                    'cosmonaut' => [
                        'name' => $flight->cosmonaut_name,
                        'birthdate' => $flight->cosmonaut_birthdate,
                        'rank' => $flight->cosmonaut_rank,
                        'bio' => [
                            'early_life' => $flight->cosmonaut_bio_early_life,
                            'career' => $flight->cosmonaut_bio_career,
                            'post_flight' => $flight->cosmonaut_bio_post_flight,
                        ],
                    ],
                ],
            ],
        ];

        // Отправляем ответ на сервер
        return response()->json($data, 200);
    }
}
