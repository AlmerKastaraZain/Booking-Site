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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('rental_id');
            $table->foreign('rental_id')->on('rentals')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('room_type_id');
            $table->foreign('room_type_id')->on('room_types')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->on('rooms')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->datetime('check_in');
            $table->datetime('check_out');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->on('teams')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
