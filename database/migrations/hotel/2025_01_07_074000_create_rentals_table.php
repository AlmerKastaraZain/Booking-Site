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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->longText('description');

            $table->unsignedBigInteger('status_id')->default('2');
            $table->foreign('status_id')->references('id')->on('statuses')->cascadeOnDelete()->cascadeOnUpdate();


            // For maps
            $table->string('country')->nullable();
            $table->string('administrative_area_level_1')->nullable();
            $table->string('administrative_area_level_2')->nullable();
            $table->string('administrative_area_level_3')->nullable();
            $table->string('administrative_area_level_4')->nullable();
            $table->string('administrative_area_level_5')->nullable();
            $table->string('administrative_area_level_6')->nullable();
            $table->string('administrative_area_level_7')->nullable();
            $table->string('full_address')->nullable();
            $table->string('locality')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('route')->nullable();
            $table->string('street_address')->nullable();

            // Lat
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->unsignedBigInteger('property_type_id');
            $table->foreign('property_type_id')->references('id')->on('property_types')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
