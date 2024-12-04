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
        Schema::table('event_services', function (Blueprint $table) {
            $table->unsignedBigInteger('service_provider_id')->after('id'); // Foreign key to the service provider
            $table->string('title'); // Title of the service (e.g., "Wedding Catering")
            $table->text('description')->nullable(); // Detailed description of the service
            $table->integer('rate')->nullable(); // Base price for the service
            $table->enum('status', ['available', 'in-progress', 'completed', 'canceled'])->default('available'); // Status of the service
            $table->date('scheduled_date')->nullable(); // Date when the service is scheduled
            $table->date('available_until')->nullable(); // Time when the service is scheduled
            $table->string('assigned_to')->nullable(); // Name or ID of the client handling the service
            $table->string('location')->nullable(); // Location where the service will take place
            $table->text('special_requests')->nullable(); // Special instructions or requests from the client
            $table->boolean('is_featured')->default(false); // Flag to indicate if this service is a featured service
            $table->foreign('service_provider_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_services', function (Blueprint $table) {
        // Drop the foreign key constraint first
        $table->dropForeign(['service_provider_id']);
        
        // Drop added columns
        $table->dropColumn([
            'service_provider_id',
            'title',
            'description',
            'rate',
            'status',
            'scheduled_date',
            'available_until',
            'assigned_to',
            'location',
            'special_requests',
            'is_featured',
        ]);  
      });

    }
};
