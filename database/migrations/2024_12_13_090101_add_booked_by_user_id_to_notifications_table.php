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
        Schema::table('notifications', function (Blueprint $table) {
            //
            $table->foreignId('booked_by_user_id')->nullable()->constrained('users')->after('user_id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            //
            // Drop the foreign key and the column if we roll back
            $table->dropForeign(['booked_by_user_id']);
            $table->dropColumn('booked_by_user_id');
        });
    }
};
