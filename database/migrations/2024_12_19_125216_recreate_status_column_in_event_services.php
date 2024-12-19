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
            $table->dropColumn('status');
        });

        // Recreate the column with new enum values
        Schema::table('event_services', function (Blueprint $table) {
            $table->enum('status', ['available', 'unavailable'])->default('available')->after('rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_services', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Recreate the original column
        Schema::table('event_services', function (Blueprint $table) {
            $table->enum('status', ['available', 'in-progress', 'completed', 'canceled'])->default('available')->before('rate');;
        });
    }
};
