<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan_sosial', function (Blueprint $table) {
            $table->id(); 

            $table->string('nama_kegiatan');
            $table->date('tanggal');
            $table->string('waktu')->nullable();
            $table->string('penanggung_jawab');
            $table->text('deskripsi')->nullable();

            $table->string('file_bukti')->nullable();
            $table->string('file_type')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_sosial');
    }
};