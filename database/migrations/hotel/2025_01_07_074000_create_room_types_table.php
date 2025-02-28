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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->longText('description');

            $table->unsignedBigInteger('rental_id');
            $table->foreign('rental_id')->on('rentals')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->decimal('price');
            $table->decimal('wide');

            $table->integer('adult');
            $table->integer('child');
            $table->integer('bed');

            $table->boolean('can_smoke');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
