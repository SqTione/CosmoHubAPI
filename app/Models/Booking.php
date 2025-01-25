<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_id',
        'user_id',
    ];

    // Устанавливаем связь с моделью SpaceFlight
    public function flight() {
        return $this->belongsTo(SpaceFlight::class);
    }

    // Устанавливаем связь с моделью User
    public function user() {
        return $this->belongsTo(User::class);
    }
}
