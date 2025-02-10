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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('serviceprovider_id')->constrained('users')->onDelete('cascade');
            $table->string('clientname');
            $table->string('phonenumber');
            $table->string('address');
            $table->string('servicename');
            $table->decimal('price', 10, 2);
            $table->date('dateofappointment');
            $table->string('mop');
            $table->string('gcashreceipt')->nullable();
            $table->string('status')->default('on-process');
            $table->text('comment')->default("none");
            $table->decimal('rating', 2, 1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
