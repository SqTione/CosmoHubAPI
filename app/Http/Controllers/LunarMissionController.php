<?php

namespace App\Http\Controllers;

use App\Models\LunarMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LunarMissionController extends Controller
{
    // Функция получения всех лунных миссий
    public function index() {
        $missions = LunarMission::all();

        $data = $missions->map(function($mission) {
            return [
                'data' => [
                    'mission' => [
                        'name' => $mission->name,
                        'launch_details' => [
                            'launch_date' => $mission->launch_date,
                            'launch_site' => [
                                'name' => $mission->launch_site_name,
                                'latitude' => $mission->launch_latitude,
                                'longitude' => $mission->launch_longitude,
                            ],
                        ],
                        'landing_details' => [
                            'landing_date' => $mission->landing_date,
                            'landing_site' => [
                                'name' => $mission->landing_site_name,
                                'latitude' => $mission->landing_latitude,
                                'longitude' => $mission->landing_longitude,
                            ],
                        ],
                        'spacecraft' => [
                            'command_module' => $mission->command_module,
                            'lunar_module' => $mission->lunar_module,
                        ],
                    ],
                ],
            ];
        });

        // Возвращаем ответ серверу с информацией
        return response()->json($data, 200);
    }

    // Функция добавления данных о миссиях
    public function store(Request $request) {
        // Настройка валидации
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'launch_date' => 'required|date',
            'launch_site_name' => 'required|string',
            'launch_latitude' => 'required|numeric',
            'launch_longitude' => 'required|numeric',
            'landing_date' => 'required|date',
            'landing_site_name' => 'required|string',
            'landing_latitude' => 'required|numeric',
            'landing_longitude' => 'required|numeric',
            'command_module' => 'required|string',
            'lunar_module' => 'required|string',
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

        // Создаём новую миссию
        $mission = LunarMission::create([
            'name' => $request->name,
            'launch_date' => $request->launch_date,
            'launch_site_name' => $request->launch_site_name,
            'launch_latitude' => $request->launch_latitude,
            'launch_longitude' => $request->launch_longitude,
            'landing_date' => $request->landing_date,
            'landing_site_name' => $request->landing_site_name,
            'landing_latitude' => $request->landing_latitude,
            'landing_longitude' => $request->landing_longitude,
            'command_module' => $request->command_module,
            'lunar_module' => $request->lunar_module,
        ]);

        return response()->json([
            'data' => [
                'code' => 201,
                'message' => 'Миссия добавлена',
            ],
        ], 201);
    }


    // Функция обновления миссии
    public function update(Request $request, LunarMission $mission) {
        // Настройка валидации
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string',
            'launch_date' => 'sometimes|date',
            'launch_site_name' => 'sometimes|string',
            'launch_latitude' => 'sometimes|numeric',
            'launch_longitude' => 'sometimes|numeric',
            'landing_date' => 'sometimes|date',
            'landing_site_name' => 'sometimes|string',
            'landing_latitude' => 'sometimes|numeric',
            'landing_longitude' => 'sometimes|numeric',
            'command_module' => 'sometimes|string',
            'lunar_module' => 'sometimes|string',
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

        // Отфильтровываем только заполненные данные
        $filteredData = $request->only([
            'name',
            'launch_date',
            'launch_site_name',
            'launch_latitude',
            'launch_longitude',
            'landing_date',
            'landing_site_name',
            'landing_latitude',
            'landing_longitude',
            'command_module',
            'lunar_module',
        ]);

        // Обновление миссии
        $mission->update($filteredData);

        // Возвращаем ответ сервера
        return response()->json([
           'data' => [
               'code' => 200,
               'message' => 'Миссия обновлена',
           ],
        ], 200);
    }

    // Функция удаления миссии
    public function destroy(LunarMission $mission) {
        // Удаляем миссию
        $mission->delete();

        // Возвращаем ответ
        return response()->noContent();
    }
}
