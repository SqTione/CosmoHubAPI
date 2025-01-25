<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\GagarinFlightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

// Маршрут регистрации пользователя
Route::post('/registration', [UserController::class, 'store']);

// Маршрут аутентификации пользователя
Route::post('/authorization', [LoginController::class, 'login'])->name('login');

// Маршрут выхода из аккаунта
Route::get('/logout', [LoginController::class, 'logout']);

// Маршрут получения данных о полёте Гагарина
Route::get('/api/gagarin-flight', [GagarInFlightController::class, 'index']);

// Маршрут получения данных о полётах
Route::get('/flight', [FlightController::class, 'index']);
