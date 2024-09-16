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
    Schema::create('services', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->string('service_name');
    $table->string('phone_number');
    $table->string('address');
    $table->string('gcashnumber');
    $table->string('gcashname');
    $table->text('description')->nullable();
    $table->decimal('price', 10, 2);
    $table->string('photo_path')->nullable();
    $table->timestamps();


    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
