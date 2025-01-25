<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Astronaut',
            'last_name' => 'Astronaut',
            'patronymic' => 'Astronaut',
            'email' => 'passenger@moon.ru',
            'password' => Hash::make('P@rtyAstr0nauts'),
            'birth_date' => '1990-01-01',
        ]);

        User::create([
            'first_name' => 'Astronaut',
            'last_name' => 'Astronaut',
            'patronymic' => 'Astronaut',
            'email' => 'passenger@mars.ru',
            'password' => Hash::make('QwertyP@rtyAstr0nauts'),
            'birth_date' => '1990-01-01',
        ]);
    }
}
