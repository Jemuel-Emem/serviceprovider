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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // Refers to the client (user_id)
            $table->unsignedBigInteger('serviceprovider_id'); // Refers to the service provider
            $table->text('message'); // The message content
            $table->boolean('from_client')->default(true); // To identify who sent the message
            $table->boolean('is_read')->default(false);
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('serviceprovider_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
