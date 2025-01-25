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
        'launch_site_name',
        'launch_latitude',
        'launch_longitude',
        'landing_date',
        'landing_site_name',
        'landing_latitude',
        'landing_longitude',
        'command_module',
        'lunar_module',
    ];
}
