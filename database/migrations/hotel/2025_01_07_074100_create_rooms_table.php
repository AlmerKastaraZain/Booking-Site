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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            
            $table->unsignedBigInteger('rental_id');
            $table->foreign('rental_id')->on('rentals')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('room_type_id');
            $table->foreign('room_type_id')->on('room_types')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
