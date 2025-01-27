<?php

namespace App\Http\Controllers;

use App\Models\CrewMember;
use App\Models\LunarMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LunarMissionController extends Controller
{
    // Функция получения всех лунных миссий
    public function index()
    {
        $missions = LunarMission::with(['launchSite', 'landingSite', 'crewMembers'])->get();

        $data = $missions->map(function ($mission) {
            return [
                'mission' => [
                    'name' => $mission->name,
                    'launch_details' => [
                        'launch_date' => $mission->launch_date,
                        'launch_site' => [
                            'name' => $mission->launchSite->name,
                            'location' => [
                                'latitude' => $mission->launchSite->latitude,
                                'longitude' => $mission->launchSite->longitude,
                            ],
                        ],
                    ],
                    'landing_details' => [
                        'landing_date' => $mission->landing_date,
                        'landing_site' => [
                            'name' => $mission->landingSite->name,
                            'coordinates' => [
                                'latitude' => $mission->landingSite->latitude,
                                'longitude' => $mission->landingSite->longitude,
                            ],
                        ],
                    ],
                    'spacecraft' => [
                        'command_module' => $mission->command_module,
                        'lunar_module' => $mission->lunar_module,
                        'crew' => $mission->crewMembers->map(function ($member) {
                            return [
                                'name' => $member->name,
                                'role' => $member->role,
                            ];
                        }),
                    ],
                ],
            ];
        });

        return response()->json($data, 200);
    }

    // Функция добавления данных о миссиях
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'launch_date' => 'required|date',
            'landing_date' => 'required|date',
            'command_module' => 'required|string',
            'lunar_module' => 'required|string',
            'launch_site.name' => 'required|string',
            'launch_site.latitude' => 'required|numeric',
            'launch_site.longitude' => 'required|numeric',
            'landing_site.name' => 'required|string',
            'landing_site.latitude' => 'required|numeric',
            'landing_site.longitude' => 'required|numeric',
            'crew' => 'required|array|min:1',
            'crew.*.name' => 'required|string',
            'crew.*.role' => 'required|string',
        ]);

        $mission = LunarMission::create([
            'name' => $validated['name'],
            'launch_date' => $validated['launch_date'],
            'landing_date' => $validated['landing_date'],
            'command_module' => $validated['command_module'],
            'lunar_module' => $validated['lunar_module'],
        ]);

        $mission->launchSite()->create($validated['launch_site']);
        $mission->landingSite()->create($validated['landing_site']);
        $mission->crewMembers()->createMany($validated['crew']);

        return response()->json([
            'data' => [
                'code' => 201,
                'message' => 'Миссия успешно создана',
            ],
        ], 201);
    }

    // Функция обновления миссии
    public function update(Request $request, LunarMission $mission)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'launch_date' => 'required|date',
            'landing_date' => 'required|date',
            'command_module' => 'required|string',
            'lunar_module' => 'required|string',
            'launch_site.name' => 'required|string',
            'launch_site.latitude' => 'required|numeric',
            'launch_site.longitude' => 'required|numeric',
            'landing_site.name' => 'required|string',
            'landing_site.latitude' => 'required|numeric',
            'landing_site.longitude' => 'required|numeric',
            'crew' => 'required|array|min:1',
            'crew.*.id' => 'required|exists:crew_members,id',
            'crew.*.name' => 'required|string',
            'crew.*.role' => 'required|string',
        ]);

        $mission->update([
            'name' => $validated['name'],
            'launch_date' => $validated['launch_date'],
            'landing_date' => $validated['landing_date'],
            'command_module' => $validated['command_module'],
            'lunar_module' => $validated['lunar_module'],
        ]);

        $mission->launchSite()->update($validated['launch_site']);
        $mission->landingSite()->update($validated['landing_site']);

        foreach ($validated['crew'] as $crewMember) {
            CrewMember::where('id', $crewMember['id'])->update([
                'name' => $crewMember['name'],
                'role' => $crewMember['role'],
            ]);
        }

        return response()->json([
            'data' => [
                'code' => 200,
                'message' => 'Миссия успешно обновлена',
            ],
        ], 200);
    }

    // Функция удаления миссии
    public function destroy(LunarMission $mission)
    {
        $mission->delete();

        return response()->json([
            'data' => [
                'code' => 204,
                'message' => 'Миссия успешно удалена',
            ],
        ], 204);
    }

    // Функция поиска
    public function search(Request $request)
    {
        // Получаем значение параметра query из GET-запроса
        $query = $request->query('query');

        // Выполняем поиск по миссиям и членам экипажа
        $missions = LunarMission::with(['launchSite', 'landingSite', 'crewMembers'])
            ->where('name', 'like', '%' . $query . '%')  // Поиск по имени миссии
            ->orWhereHas('launchSite', function ($queryBuilder) use ($query) {
                // Поиск по имени места старта
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->orWhereHas('landingSite', function ($queryBuilder) use ($query) {
                // Поиск по имени места посадки
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->orWhereHas('crewMembers', function ($queryBuilder) use ($query) {
                // Поиск по имени члена экипажа
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->get();

        // Формируем данные для вывода
        $data = $missions->map(function ($mission) {
            return [
                'type' => 'Миссия',
                'name' => $mission->name,
                'launch_date' => $mission->launch_date,
                'landing_date' => $mission->landing_date,
                'crew' => $mission->crewMembers->map(function ($member) {
                    return [
                        'name' => $member->name,
                        'role' => $member->role,
                    ];
                }),
                'landing_site' => $mission->landingSite->name ?? null,
            ];
        });

        // Возвращаем результат в формате JSON
        return response()->json(['data' => $data], 200);
    }

}
