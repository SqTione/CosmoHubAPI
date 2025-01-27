<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunarMission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'launch_date',
        'landing_date',
        'command_module',
        'lunar_module'
    ];

    public function launchSite()
    {
        return $this->hasOne(LaunchSite::class);
    }

    public function landingSite()
    {
        return $this->hasOne(LandingSite::class);
    }

    public function crewMembers()
    {
        return $this->hasMany(CrewMember::class);
    }
}
