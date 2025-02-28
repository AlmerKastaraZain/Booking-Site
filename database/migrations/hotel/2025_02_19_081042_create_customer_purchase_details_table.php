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
        Schema::create('customer_purchase_details', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')->on('customer_purchases')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('rental_id');
            $table->foreign('rental_id')->on('rentals')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('room_type_id');
            $table->foreign('room_type_id')->on('room_types')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('item_name');
            $table->integer('price');
            $table->integer('amount');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_purchase_details');
    }
};
