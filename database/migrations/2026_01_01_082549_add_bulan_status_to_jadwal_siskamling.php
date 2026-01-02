<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_siskamling', function (Blueprint $table) {
            $table->string('bulan')->after('tanggal');
            $table->enum('status', ['aktif', 'selesai'])->default('aktif')->after('bulan');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_siskamling', function (Blueprint $table) {
            $table->dropColumn(['bulan', 'status']);
        });
    }
};
