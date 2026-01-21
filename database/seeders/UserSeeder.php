<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun Tenant 
        User::create([
            'name' => 'Made Tenant',
            'email' => 'tenant@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'tenant',
            'phone_whatsapp' => '08123456789',
        ]);

        // Membuat akun Owner
        User::create([
            'name' => 'Krisna Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
            'phone_whatsapp' => '08987654321',
        ]);

        // Membuat akun Admin
        User::create([
            'name' => 'Admin Kodyakost',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone_whatsapp' => '08765432109',
        ]);
    }
}