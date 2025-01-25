<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gagarin_flights', function (Blueprint $table) {
            $table->id();
            $table->string('mission_name');
            $table->date('launch_date');
            $table->string('launch_site_name');
            $table->decimal('launch_site_latitude', 10, 7);
            $table->decimal('launch_site_longitude', 10, 7);
            $table->integer('flight_duration_hours');
            $table->integer('flight_duration_minutes');
            $table->string('spacecraft_name');
            $table->string('spacecraft_manufacturer');
            $table->integer('spacecraft_crew_capacity');
            $table->date('landing_date');
            $table->string('landing_site_name');
            $table->string('landing_site_country');
            $table->decimal('landing_site_latitude', 10, 7);
            $table->decimal('landing_site_longitude', 10, 7);
            $table->boolean('parachute_landing');
            $table->decimal('impact_velocity_mps', 8, 2);
            $table->string('cosmonaut_name');
            $table->date('cosmonaut_birthdate');
            $table->string('cosmonaut_rank');
            $table->text('cosmonaut_bio_early_life');
            $table->text('cosmonaut_bio_career');
            $table->text('cosmonaut_bio_post_flight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gagarin_flights');
    }
};
