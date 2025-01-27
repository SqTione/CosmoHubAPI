<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\GagarinFlightController;
use App\Http\Controllers\LunarMissionController;
use App\Http\Controllers\SpaceFlightController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LunarWatermarkController;

// --- Вход, регистрация и выход ---
Route::group([], function () {
    // Регистрация пользователя
    Route::post('/registration', [UserController::class, 'store']);

    // Аутентификация пользователя
    Route::post('/authorization', [LoginController::class, 'login'])->name('login');

    // Выход из аккаунта
    Route::middleware('auth:api')->get('/logout', [LoginController::class, 'logout']);
});

// --- Полёты ---
Route::group([], function () {
    // Получение данных о полёте Гагарина
    Route::middleware('auth:api')->get('/api/gagarin-flight', [GagarInFlightController::class, 'index']);

    // Получение данных о полётах
    Route::middleware('auth:api')->get('/flight', [FlightController::class, 'index']);
});

// --- Лунные миссии ---
Route::group([], function () {
    // Получение всех лунных миссий
    Route::middleware('auth:api')->get('/lunar-missions', [LunarMissionController::class, 'index']);

    // Создание новой лунной миссии
    Route::middleware('auth:api')->post('/lunar-missions', [LunarMissionController::class, 'store']);

    // Обновление лунной миссии
    Route::middleware('auth:api')->patch('/lunar-missions/{mission}', [LunarMissionController::class, 'update']);

    // Удаление лунной миссии
    Route::middleware('auth:api')->delete('/lunar-missions/{mission}', [LunarMissionController::class, 'destroy']);
});

// --- Космические полёты ---
Route::group([], function () {
    // Получение всех космических полётов
    Route::middleware('auth:api')->get('/space-flights', [SpaceFlightController::class, 'index']);

    // Создание нового космического полёта
    Route::middleware('auth:api')->post('/space-flights', [SpaceFlightController::class, 'store']);

    // Регистрация на космический рейс
    Route::middleware('auth:api')->post('/book-flight', [BookingController::class, 'store']);
});

// Создание нового космического полёта
Route::middleware('auth:api')->post('/space-flights', [SpaceFlightController::class, 'store']);

// Регистрация на космический рейс
Route::middleware('auth:api')->post('/book-flight', [BookingController::class, 'store']);

// Создание изображения с водяным знаком на Луне
Route::middleware('auth:api')->post('/lunar-watermark', [LunarWatermarkController::class, 'store']);
