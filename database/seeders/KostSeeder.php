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
            'is_verified' => true,
            'thumbnail' => 'https://i.pinimg.com/736x/20/6e/e8/206ee8503c87ee66394c1eae81d56885.jpg',
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

        $room1->images()->createMany([
            ['image_path' => 'https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg'], 
            ['image_path' => 'https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg'], 
            ['image_path' => 'https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg'], 
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
            'is_verified' => true,
            'thumbnail' => 'https://i.pinimg.com/736x/6f/66/f7/6f66f782f4b4fb3fab18ce2f6d3e3857.jpg',
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

        $room2->images()->createMany([
            ['image_path' => 'https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg'], 
            ['image_path' => 'https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg'], 
            ['image_path' => 'https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg'], 
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
            'is_verified' => true,
            'thumbnail' => 'https://i.pinimg.com/736x/20/6e/e8/206ee8503c87ee66394c1eae81d56885.jpg',
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

        $room3->images()->createMany([
            ['image_path' => 'https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg'], 
            ['image_path' => 'https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg'], 
            ['image_path' => 'https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg'], 
        ]);

        $room3->facilities()->attach($allFacilities->whereIn('name', ['AC', 'WiFi', 'Laundry'])->pluck('id'));

        // DATA KOS 4: Denpasar Utara (Padangsambian)
        $kost4 = Kost::create([
            'user_id' => $owner->id,
            'name' => 'Padangsambian Cozy Kost',
            'description' => 'Dekat dengan kampus ISI dan fasilitas umum.',
            'address' => 'Jl. Padangsambian Kangin No. 45',
            'district' => 'Denpasar Utara',
            'village' => 'Padangsambian',
            'latitude' => -8.650000,
            'longitude' => 115.220000,
            'is_verified' => true,
            'thumbnail' => 'https://i.pinimg.com/736x/6f/66/f7/6f66f782f4b4fb3fab18ce2f6d3e3857.jpg',
        ]);
        // Tambah Kamar untuk Kos 4
        $room4 = Room::create([
            'kost_id' => $kost4->id,
            'room_type' => 'Deluxe',
            'price_per_month' => 1800000,
            'total_rooms' => 12,
            'available_rooms' => 4,
            'room_size' => '4x3'
        ]);

        $room4->images()->createMany([
            ['image_path' => 'https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg'], 
            ['image_path' => 'https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg'], 
            ['image_path' => 'https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg'], 
        ]);

        $room4->facilities()->attach($allFacilities->whereIn('name', ['AC', 'Dapur', 'Parkir'])->pluck('id'));

        // DATA KOS 5: Denpasar Selatan (Sanur)
        $kost5 = Kost::create([
            'user_id' => $owner->id,
            'name' => 'Sanur Beach Kost',
            'description' => 'Suasana pantai yang menenangkan, cocok untuk mahasiswa.',
            'address' => 'Jl. Danau Tamblingan No. 88',
            'district' => 'Denpasar Selatan',
            'village' => 'Sanur',
            'latitude' => -8.680000,
            'longitude' => 115.250000,
            'is_verified' => true,
            'thumbnail' => 'https://i.pinimg.com/736x/20/6e/e8/206ee8503c87ee66394c1eae81d56885.jpg',
        ]);
        // Tambah Kamar untuk Kos 5
        $room5 = Room::create([
            'kost_id' => $kost5->id,
            'room_type' => 'Standard',
            'price_per_month' => 1000000,
            'total_rooms' => 20,
            'available_rooms' => 10,
            'room_size' => '3x3',
        ]);

        $room5->images()->createMany([
            ['image_path' => 'https://i.pinimg.com/736x/58/bf/af/58bfafa0ad1588e72bd3367254737960.jpg'], 
            ['image_path' => 'https://i.pinimg.com/1200x/af/6c/53/af6c53270ec27e3892cbfad02c961ebf.jpg'], 
            ['image_path' => 'https://i.pinimg.com/736x/1c/60/ca/1c60ca5c8b0cf0e6b58d07e4f8d742fa.jpg'], 
        ]);

        $room5->facilities()->attach($allFacilities->whereIn('name', ['WiFi', 'Kamar Mandi Dalam', 'Meja Belajar'])->pluck('id'));
    }
}