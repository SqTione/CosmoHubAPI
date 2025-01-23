<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Функция входа
    public function login(Request $request) {
        // Настройка валидации
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Обработка ошибки валидации
        if($validator->fails()) {
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ],
            ], 422);
        }

        // Авторизация пользователя
        if (Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password
        ])) {
            $user = Auth::user();
            $token = $user->createToken('CosmoHubAPI')->accessToken;

            // Формируем полное имя
            $fullName = "{$user->last_name} {$user->first_name} {$user->patronymic}";

            // Ответ сервера
            return response()->json([
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $fullName,
                        'bith_date' => $user->birth_date,
                        'email' => $user->email
                    ],
                    'token' => $token,
                ]
            ], 200);
        }

        // При ошибке отправляем ответ
        return response()->json([
            'error' => [
                'code' => 401,
                'message' => 'Unathorized',
                'errors' => 'Email or password is incorrect'
            ]
        ]);
    }

    // TODO: Похоже, функция выхода не работает. Всегда ошибка "User is not authorized"
    // Функция логаута
    public function logout(Request $request) {
        $user = Auth::user();
    
        if ($user) {
            $user->api_token = null; 
            $user->save();
        } else {
            // Если пользователь не аутентифицирован, возвращаем ошибку (в задании такого нет)
            return response()->json([
                'error' => [
                    'code' => 401,
                    'message' => 'Unathorized',
                    'errors' => 'User is not authorized'
                ]
            ]);
        }
    
        return response()->noContent(); // Возвращаем пустой ответ
    }
}
