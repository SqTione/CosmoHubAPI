<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Маршрут регистрации пользователя
Route::post('/registration', [UserController::class, 'store']);