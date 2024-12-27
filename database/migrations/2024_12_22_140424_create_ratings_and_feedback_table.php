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
        Schema::create('ratings_and_feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_service_id');
            $table->unsignedBigInteger('user_id'); // The user giving the rating/feedback
            $table->unsignedTinyInteger('rating')->nullable(); // Rating from 1-5
            $table->text('feedback')->nullable(); // Optional feedback
            $table->timestamps();

            // Foreign keys
            $table->foreign('event_service_id')->references('id')->on('event_services')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings_and_feedback');
    }
};
