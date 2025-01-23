<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Функция создания контроллера
    public function Store(Request $request) {
        // Настройка валидации
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|regex:/^[A-Za-zА-ЯЁа-яё]+$/u',
            'last_name' => 'required|string|regex:/^[A-Za-zА-ЯЁа-яё]+$/u',
            'patronymic' => 'required|string|regex:/^[A-Za-zА-ЯЁа-яё]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:3|regex:/^(?=.*[a-zA-Z])(?=.*\d).*$/',
            'birth_date' => 'required|date_format:Y-m-d'    // Формат даты гггг-мм-дд
        ]);

        // Обработка ошибки валидации
        if($validator->fails()) {
            // Вывод в требуемом формате
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ],
            ], 422);
        }

        // Создаем нового пользователя
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'patronymic' => $request->patronymic,
            'email' => $request->email,
            'password' => Hash::make($request->password),   // Хэшируем пароль
            'birth_date' => $request->birth_date,
        ]);

        // Формируем полное имя
        $fullName = "{$user->last_name} {$user->first_name} {$user->patronymic}";

        return response()->json([
            'data' => [
                'user' => [
                    'name' => $fullName,
                    'email' => $user->email,
                ],
                'code' => 201,
                'message' => 'Пользователь создан',
            ]
        ], 201);
    }
}
