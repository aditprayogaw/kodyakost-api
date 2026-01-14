<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kost;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    $this->call([
        UserSeeder::class,      // Membuat Made Tenant & Krisna Owner
        FacilitySeeder::class,  // Membuat AC, WiFi, dll
        KostSeeder::class,      // Membuat Data Kos Asli di Denpasar
    ]);

    // Jika ingin tambah user random untuk keramaian, baru pakai factory:
    User::factory(5)->create(['role' => 'tenant']);
}
}