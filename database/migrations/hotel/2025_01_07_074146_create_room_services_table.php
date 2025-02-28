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
        Schema::create('room_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_id');
            $table->foreign('rental_id')->on('rentals')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('room_type_id');
            $table->foreign('room_type_id')->on('room_types')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->on('room_services_features')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->double('cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_services');
    }
};
