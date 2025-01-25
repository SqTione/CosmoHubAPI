<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceFlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_number',
        'destination',
        'launch_date',
        'seats_available',
    ];

    // Связь с моделью Booking
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
