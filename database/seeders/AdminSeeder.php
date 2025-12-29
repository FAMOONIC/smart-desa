<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nik' => '0000000000000001',
            'email' => 'admin@desa.local',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}
