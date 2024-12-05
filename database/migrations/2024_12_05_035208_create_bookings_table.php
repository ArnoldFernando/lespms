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
            $table->unsignedBigInteger('user_id'); // Foreign key to users (the customer)
            $table->unsignedBigInteger('event_service_id'); // Foreign key to event_services
            $table->date('booking_date'); // Date of booking
            $table->enum('status', ['pending', 'confirmed', 'canceled', 'completed'])->default('pending'); // Booking status
            $table->text('notes')->nullable(); // Additional notes from the customer
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_service_id')->references('id')->on('event_services')->onDelete('cascade');
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
