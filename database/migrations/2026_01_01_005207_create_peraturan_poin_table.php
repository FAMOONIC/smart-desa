<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peraturan_poin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peraturan_id')
                  ->constrained('peraturan')
                  ->cascadeOnDelete();
            $table->text('isi');
            $table->integer('urutan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peraturan_poin');
    }
};
