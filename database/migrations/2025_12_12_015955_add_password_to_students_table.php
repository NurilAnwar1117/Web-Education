<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // tambahkan kolom password setelah year_entry
            $table->string('password')->after('year_entry');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // rollback: hapus kolom password
            $table->dropColumn('password');
        });
    }
};
