<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kost;

class KostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kos 1: Denpasar Selatan (Panjer)
        Kost::create([
            'user_id' => 2, // Pastikan ID owner ini ada di tabel users
            'name' => 'D’Panjer Residence',
            'description' => 'Kos eksklusif dekat kampus UNUD Sudirman.',
            'address' => 'Jl. Tukad Pakerisan No. 99',
            'district' => 'Denpasar Selatan',
            'village' => 'Panjer',
            'latitude' => -8.675000,
            'longitude' => 115.234000,
            'is_verified' => true
        ]);

        // Kos 2: Denpasar Timur (Renon)
        Kost::create([
            'user_id' => 2,
            'name' => 'Renon Garden Kost',
            'description' => 'Lingkungan tenang, dekat dengan Lapangan Niti Mandala.',
            'address' => 'Jl. Raya Puputan Gang IV',
            'district' => 'Denpasar Timur',
            'village' => 'Sumerta Kelod',
            'latitude' => -8.670000,
            'longitude' => 115.245000,
            'is_verified' => true
        ]);

        // Kos 3: Denpasar Barat (Teuku Umar)
        Kost::create([
            'user_id' => 2,
            'name' => 'Teuku Umar Stay',
            'description' => 'Akses mudah ke pusat perbelanjaan dan kuliner.',
            'address' => 'Jl. Teuku Umar No. 10',
            'district' => 'Denpasar Barat',
            'village' => 'Dauh Puri',
            'latitude' => -8.678000,
            'longitude' => 115.210000,
            'is_verified' => false
        ]);
    }
}
