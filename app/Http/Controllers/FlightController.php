<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index() {
        $flights = Flight::all();

        // Получаем информацию о полётах
        $data = $flights->map(function($flight) {
            return [
                'data' => [
                    'name' => $flight->name,
                    'crew_capacity' => $flight->crew_capacity,
                    'launch_details' => [
                        'launch_date' => $flight->launch_date,
                        'launch_site' => [
                            'name' => $flight->launch_site_name,
                            'latitude' => $flight->launch_latitude,
                            'longitude' => $flight->launch_longitude,
                        ],
                    ],
                    'landing_details' => [
                        'landing_date' => $flight->landing_date,
                        'landing_site' => [
                            'name' => $flight->landing_site_name,
                            'latitude' => $flight->landing_latitude,
                            'longitude' => $flight->landing_longitude,
                        ],
                    ],
                ],
            ];
        });

        // Возвращаем ответ серверва
        return response()->json(['data' => $data],200);
    }
}
