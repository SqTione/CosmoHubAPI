<?php

namespace Database\Seeders;

use App\Models\CrewMember;
use App\Models\LandingSite;
use App\Models\LaunchSite;
use App\Models\LunarMission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LunarMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missions = [
            [
                "mission" => [
                    "name" => "Аполлон-11",
                    "launch_details" => [
                        "launch_date" => "1969-07-16",
                        "launch_site" => [
                            "name" => "Космический центр имени Кеннеди",
                            "location" => [
                                "latitude" => "28.5721000",
                                "longitude" => "-80.6480000",
                            ]
                        ]
                    ],
                    "landing_details" => [
                        "landing_date" => "1969-07-20",
                        "landing_site" => [
                            "name" => "Море спокойствия",
                            "coordinates" => [
                                "latitude" => "0.6740000",
                                "longitude" => "23.4720000",
                            ]
                        ]
                    ],
                    "spacecraft" => [
                        "command_module" => "Колумбия",
                        "lunar_module" => "Орел",
                        "crew" => [
                            [
                                "name" => "Нил Армстронг",
                                "role" => "Командир"
                            ],
                            [
                                "name" => "Базз Олдрин",
                                "role" => "Пилот лунного модуля"
                            ],
                            [
                                "name" => "Майкл Коллинз",
                                "role" => "Пилот командного модуля"
                            ]
                        ]
                    ]
                ]
            ],
            [
                "mission" => [
                    "name" => "Аполлон-17",
                    "launch_details" => [
                        "launch_date" => "1972-12-07",
                        "launch_site" => [
                            "name" => "Космический центр имени Кеннеди",
                            "location" => [
                                "latitude" => "28.5721000",
                                "longitude" => "-80.6480000",
                            ]
                        ]
                    ],
                    "landing_details" => [
                        "landing_date" => "1972-12-19",
                        "landing_site" => [
                            "name" => "Телец-Литтров",
                            "coordinates" => [
                                "latitude" => "20.1908000",
                                "longitude" => "30.7717000",
                            ]
                        ]
                    ],
                    "spacecraft" => [
                        "command_module" => "Америка",
                        "lunar_module" => "Челленджер",
                        "crew" => [
                            [
                                "name" => "Евгений Сернан",
                                "role" => "Командир"
                            ],
                            [
                                "name" => "Харрисон Шмитт",
                                "role" => "Пилот лунного модуля"
                            ],
                            [
                                "name" => "Рональд Эванс",
                                "role" => "Пилот командного модуля"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach ($missions as $missionData) {
            $mission = LunarMission::create([
                'name' => $missionData['mission']['name'],
                'launch_date' => $missionData['mission']['launch_details']['launch_date'],
                'landing_date' => $missionData['mission']['landing_details']['landing_date'],
                'command_module' => $missionData['mission']['spacecraft']['command_module'], // Добавляем командный модуль
                'lunar_module' => $missionData['mission']['spacecraft']['lunar_module'], // Добавляем лунный модуль
            ]);

            // Добавляем место запуска
            $launchSite = LaunchSite::create([
                'lunar_mission_id' => $mission->id,
                'name' => $missionData['mission']['launch_details']['launch_site']['name'],
                'latitude' => $missionData['mission']['launch_details']['launch_site']['location']['latitude'],
                'longitude' => $missionData['mission']['launch_details']['launch_site']['location']['longitude'],
            ]);

            // Добавляем место посадки
            $landingSite = LandingSite::create([
                'lunar_mission_id' => $mission->id,
                'name' => $missionData['mission']['landing_details']['landing_site']['name'],
                'latitude' => $missionData['mission']['landing_details']['landing_site']['coordinates']['latitude'],
                'longitude' => $missionData['mission']['landing_details']['landing_site']['coordinates']['longitude'],
            ]);

            // Добавляем членов экипажа
            foreach ($missionData['mission']['spacecraft']['crew'] as $crewMember) {
                CrewMember::create([
                    'lunar_mission_id' => $mission->id,
                    'name' => $crewMember['name'],
                    'role' => $crewMember['role'],
                ]);
            }
        }
    }
}
