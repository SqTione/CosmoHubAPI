<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

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
