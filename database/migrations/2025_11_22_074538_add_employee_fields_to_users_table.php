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
        Schema::table('users', function (Blueprint $table) {
            // Add department_id as a foreign key, nullable
            $table->foreignId('department_id')
                  ->nullable()
                  ->after('role') // Place it after the 'role' column
                  ->constrained('departments')
                  ->onDelete('set null'); // If department is deleted, set this to null

            // Add position_id as a foreign key, nullable
            $table->foreignId('position_id')
                  ->nullable()
                  ->after('department_id')
                  ->constrained('positions')
                  ->onDelete('set null');

            // Add birth_date column, nullable
            $table->date('birth_date')->nullable()->after('position_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['department_id']);
            $table->dropForeign(['position_id']);
            
            // Drop the columns
            $table->dropColumn(['department_id', 'position_id', 'birth_date']);
        });
    }
};