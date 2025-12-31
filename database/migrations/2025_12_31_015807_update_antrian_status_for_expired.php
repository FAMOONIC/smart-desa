<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('antrian', function (Blueprint $table) {
            $table->string('status')->default('menunggu')->change();
        });

        DB::table('antrian')
            ->whereNotIn('status', ['menunggu', 'diproses', 'selesai', 'kadaluarsa'])
            ->update(['status' => 'menunggu']);
    }

    public function down(): void
    {
        Schema::table('antrian', function (Blueprint $table) {
            $table->string('status')->default('menunggu')->change();
        });
    }
};
