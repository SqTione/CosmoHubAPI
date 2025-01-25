<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GagarinFlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_name',
        'launch_date',
        'launch_site_name',
        'launch_site_latitude',
        'launch_site_longitude',
        'flight_duration_hours',
        'flight_duration_minutes',
        'spacecraft_name',
        'spacecraft_manufacturer',
        'spacecraft_crew_capacity',
        'landing_date',
        'landing_site_name',
        'landing_site_country',
        'landing_site_latitude',
        'landing_site_longitude',
        'parachute_landing',
        'impact_velocity_mps',
        'cosmonaut_name',
        'cosmonaut_birthdate',
        'cosmonaut_rank',
        'cosmonaut_bio_early_life',
        'cosmonaut_bio_career',
        'cosmonaut_bio_post_flight',
    ];
}
