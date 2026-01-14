<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kost;
use App\Models\Room;
use App\Models\Facility;
use App\Models\User;

class KostSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pastikan punya ID Owner dari UserSeeder
        $owner = User::where('role', 'owner')->first();
        if (!$owner) return; // Keamanan jika owner belum di-seed

        // 2. Ambil daftar fasilitas untuk relasi nanti
        $allFacilities = Facility::all();

        // --- DATA KOS 1: Denpasar Selatan (Panjer) ---
        $kost1 = Kost::create([
            'user_id' => $owner->id,
            'name' => 'D\'Panjer Residence',
            'description' => 'Kos eksklusif dekat kampus UNUD Sudirman.',
            'address' => 'Jl. Tukad Pakerisan No. 99',
            'district' => 'Denpasar Selatan',
            'village' => 'Panjer',
            'latitude' => -8.675000,
            'longitude' => 115.234000,
            'is_verified' => true
        ]);

        // Tambah Kamar untuk Kos 1
        $room1 = Room::create([
            'kost_id' => $kost1->id,
            'room_type' => 'VIP',
            'price_per_month' => 2000000,
            'total_rooms' => 10,
            'available_rooms' => 3,
            'room_size' => '4x4'
        ]);
        // Hubungkan ke fasilitas (AC, WiFi, KM Dalam)
        $room1->facilities()->attach($allFacilities->whereIn('name', ['AC', 'WiFi', 'Kamar Mandi Dalam'])->pluck('id'));


        // --- DATA KOS 2: Denpasar Timur (Renon) ---
        $kost2 = Kost::create([
            'user_id' => $owner->id,
            'name' => 'Renon Garden Kost',
            'description' => 'Lingkungan tenang, dekat dengan Lapangan Niti Mandala.',
            'address' => 'Jl. Raya Puputan Gang IV',
            'district' => 'Denpasar Timur',
            'village' => 'Sumerta Kelod',
            'latitude' => -8.670000,
            'longitude' => 115.245000,
            'is_verified' => true
        ]);

        // Tambah Kamar untuk Kos 2
        $room2 = Room::create([
            'kost_id' => $kost2->id,
            'room_type' => 'Standard',
            'price_per_month' => 1200000,
            'total_rooms' => 15,
            'available_rooms' => 5,
            'room_size' => '3x3'
        ]);
        $room2->facilities()->attach($allFacilities->whereIn('name', ['WiFi', 'Lemari', 'Meja Belajar'])->pluck('id'));


        // --- DATA KOS 3: Denpasar Barat (Teuku Umar) ---
        $kost3 = Kost::create([
            'user_id' => $owner->id,
            'name' => 'Teuku Umar Stay',
            'description' => 'Akses mudah ke pusat perbelanjaan dan kuliner.',
            'address' => 'Jl. Teuku Umar No. 10',
            'district' => 'Denpasar Barat',
            'village' => 'Dauh Puri',
            'latitude' => -8.678000,
            'longitude' => 115.210000,
            'is_verified' => false
        ]);

        // Tambah Kamar untuk Kos 3
        $room3 = Room::create([
            'kost_id' => $kost3->id,
            'room_type' => 'Standard AC',
            'price_per_month' => 1500000,
            'total_rooms' => 8,
            'available_rooms' => 0, // Full
            'room_size' => '3x4'
        ]);
        $room3->facilities()->attach($allFacilities->whereIn('name', ['AC', 'WiFi', 'Laundry'])->pluck('id'));
    }
}