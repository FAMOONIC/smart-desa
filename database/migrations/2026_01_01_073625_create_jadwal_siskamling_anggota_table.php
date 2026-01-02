<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_siskamling_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')
                  ->constrained('jadwal_siskamling')
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['jadwal_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_siskamling_anggota');
    }
};
