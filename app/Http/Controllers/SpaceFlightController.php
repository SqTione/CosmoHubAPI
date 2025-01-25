<?php

namespace App\Http\Controllers;

use App\Models\SpaceFlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpaceFlightController extends Controller
{
    // Получение списка космических рейсов
    public function index() {
        $flights = SpaceFlight::all();

        $data = $flights->map(function($flight) {
            return [
                'data' => [
                    'flight_number' => $flight->flight_number,
                    'destination' => $flight->destination,
                    'launch_date' => $flight->launch_date,
                    'seats_available' => $flight->seats_available,
                ],
            ];
        });

        return response()->json($data, 200);
    }

    // Функция создания космического рейса
    public function store(Request $request) {
        // Настройка валидации
        $validator = Validator::make($request->all(), [
            'flight_number' => 'required|string',
            'destination' => 'required|string',
            'launch_date' => 'required|date',
            'seats_available' => 'required|integer',
        ]);

        // Проверка валидации
        if ($validator->fails()) {
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ],
            ], 422);
        }

        // Создаём новый полёт
        $flight = SpaceFlight::create([
            'flight_number' => $request->flight_number,
            'destination' => $request->destination,
            'launch_date' => $request->launch_date,
            'seats_available' => $request->seats_available,
        ]);

        // Возвращаем ответ сервера
        return response()->json([
            'data' => [
                'code' => 201,
                'message' => 'Космический полёт добавлена',
            ],
        ], 201);
    }
}
