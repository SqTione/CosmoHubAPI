<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\GagarinFlightController;
use App\Http\Controllers\LunarMissionController;
use App\Http\Controllers\SpaceFlightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;

// --- Вход, регистрация и выход ---
// Маршрут регистрации пользователя
Route::post('/registration', [UserController::class, 'store']);

// Маршрут аутентификации пользователя
Route::post('/authorization', [LoginController::class, 'login'])->name('login');

// Маршрут выхода из аккаунта
Route::middleware('auth:api')->get('/logout', [LoginController::class, 'logout']);

// --- Полёты ---
// Маршрут получения данных о полёте Гагарина
Route::get('/api/gagarin-flight', [GagarInFlightController::class, 'index']);

// Маршрут получения данных о полётах
Route::get('/flight', [FlightController::class, 'index']);

// --- Лунные миссии ---
// Маршрут получения всех лунных миссий
Route::get('/lunar-missions', [LunarMissionController::class, 'index']);

// Маршрут создания новой лунной миссии
Route::post('/lunar-missions', [LunarMissionController::class, 'store']);

//Маршрут обновления лунной миссии
Route::patch('/lunar-missions/{mission}', [LunarMissionController::class, 'update']);

//Маршрут удаления лунной миссии
Route::delete('/lunar-missions/{mission}', [LunarMissionController::class, 'destroy']);

// --- Космические полёты ---
// Получение всех космических полётов
Route::get('/space-flights', [SpaceFlightController::class, 'index']);

// Создание нового космического полёта
Route::post('/space-flights', [SpaceFlightController::class, 'store']);

// Регистрация на космический рейс
Route::middleware('auth:api')->post('/book-flight', [BookingController::class, 'store']);
