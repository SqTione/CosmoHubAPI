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
        Schema::table('lunar_missions', function (Blueprint $table) {
            $table->dropColumn(['launch_site_name', 'launch_latitude', 'launch_longitude', 'landing_site_name', 'landing_latitude', 'landing_longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lunar_missions', function (Blueprint $table) {
            $table->string('launch_site_name');
            $table->decimal('launch_latitude', 10, 7);
            $table->decimal('launch_longitude', 10, 7);
            $table->string('landing_site_name');
            $table->decimal('landing_latitude', 10, 7);
            $table->decimal('landing_longitude', 10, 7);
        });
    }
};
