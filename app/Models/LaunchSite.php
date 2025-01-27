<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaunchSite extends Model
{
    use HasFactory;

    protected $fillable = ['lunar_mission_id', 'name', 'latitude', 'longitude'];

    public function mission()
    {
        return $this->belongsTo(LunarMission::class);
    }
}
