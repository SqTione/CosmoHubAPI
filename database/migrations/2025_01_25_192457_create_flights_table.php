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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('crew_capacity');
            $table->date('launch_date');
            $table->string('launch_site_name');
            $table->decimal('launch_latitude', 10, 7);
            $table->decimal('launch_longitude', 10, 7);
            $table->date('landing_date');
            $table->string('landing_site_name');
            $table->decimal('landing_latitude', 10, 7);
            $table->decimal('landing_longitude', 10, 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
