<?php

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