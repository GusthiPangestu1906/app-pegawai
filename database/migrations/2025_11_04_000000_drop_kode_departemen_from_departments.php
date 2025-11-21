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
        if (Schema::hasColumn('departments', 'kode_departemen')) {
            Schema::table('departments', function (Blueprint $table) {
                $table->dropColumn('kode_departemen');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan kolom kode_departemen jika di-rollback
        if (! Schema::hasColumn('departments', 'kode_departemen')) {
            Schema::table('departments', function (Blueprint $table) {
                $table->string('kode_departemen', 20)->unique()->after('id');
            });
        }
    }
};
