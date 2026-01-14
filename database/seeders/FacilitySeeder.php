<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            ['name' => 'AC', 'icon' => 'ac-icon'],
            ['name' => 'WiFi', 'icon' => 'wifi-icon'],
            ['name' => 'Kamar Mandi Dalam', 'icon' => 'bathroom-icon'],
            ['name' => 'Dapur', 'icon' => 'kitchen-icon'],
            ['name' => 'Parkir', 'icon' => 'parking-icon'],
            ['name' => 'Laundry', 'icon' => 'laundry-icon'],
            ['name' => 'Lemari', 'icon' => 'wardrobe-icon'],
            ['name' => 'Meja Belajar', 'icon' => 'desk-icon'],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
