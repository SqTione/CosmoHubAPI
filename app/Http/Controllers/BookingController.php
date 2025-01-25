<?php

namespace App\Http\Controllers;

use App\Models\SpaceFlight;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function store(Request $request) {
        // Валидация запроса
        $validator = Validator::make($request->all(), [
            'flight_number' => 'required|string',
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

        // Получаем рейс по flight_number
        $flight = SpaceFlight::where('flight_number', $request->flight_number)->first();

        // Если рейс не найден
        if (!$flight) {
            return response()->json([
                'error' => [
                    'code' => 404,
                    'message' => 'Flight not found',
                    'errors' => ['Flight not found'],
                ],
            ], 404);
        }

        // Получаем аутентифицированного пользователя
        $user = $user = Auth::user();

        // Проверка доступных мест
        if ($flight->seats_available <= 0) {
            return response()->json([
                'error' => [
                    'code' => 400,
                    'message' => 'No available seats',
                    'errors' => ['No available seats'],
                ],
            ], 400);
        }

        // Создаём бронирование для рейса
        $booking = Booking::create([
            'flight_id' => $flight->id,
            'user_id' => $user->id,
        ]);

        // Обновляем количество доступных мест
        $flight->seats_available -= 1;
        $flight->save();

        // Возвращаем успешный ответ
        return response()->json([
            'data' => [
                'code' => 201,
                'message' => 'Рейс успешно забронирован',
                'booking_id' => $booking->id,
            ]
        ], 201);
    }
}
