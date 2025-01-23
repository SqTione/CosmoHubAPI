<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable  // Меняем Model на Authenticatable для работы
{
    use HasFactory, HasApiTokens;   // Подключаем для использования Laravel Passport

    // Добавляем возможность заполнять поля
    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'email',
        'password',
        'birth_date',
    ];
}
