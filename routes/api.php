<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mock API KodyaKost - Update 13 Jan 2026
|--------------------------------------------------------------------------
*/

Route::get('/mock-kosts', function () {
    return response()->json([
        'success' => true,
        'message' => '5 Data simulasi KodyaKost dengan fitur Fasilitas & Koordinat Denpasar',
        'data' => [
            [
                'id' => 1,
                'name' => 'Schmeler Kost Renon',
                'description' => 'Kos eksklusif di pusat pemerintahan, tenang dan nyaman.',
                'address' => 'Jl. Anderson Wall No. 649, Renon',
                'district' => 'Denpasar Timur',
                'latitude' => -8.679419,
                'longitude' => 115.23613,
                'is_verified' => true,
                'price_start' => 1200000,
                'thumbnail' => 'https://placehold.co/600x400?text=Kos+Renon',
                'rooms' => [
                    [
                        'type' => 'VIP', 
                        'price' => 2500000, 
                        'size' => '4x4',
                        'facilities' => [
                            ['name' => 'AC', 'icon' => 'ac_unit'],
                            ['name' => 'WiFi', 'icon' => 'wifi'],
                            ['name' => 'KM Dalam', 'icon' => 'bathtub'],
                            ['name' => 'Water Heater', 'icon' => 'hot_tub']
                        ]
                    ],
                    [
                        'type' => 'Standard', 
                        'price' => 1200000, 
                        'size' => '3x3',
                        'facilities' => [
                            ['name' => 'WiFi', 'icon' => 'wifi'],
                            ['name' => 'Kipas Angin', 'icon' => 'mode_fan']
                        ]
                    ]
                ]
            ],
            [
                'id' => 2,
                'name' => 'Ward-Prosacco Sidakarya',
                'description' => 'Dekat dengan area kampus dan akses mudah ke Bypass.',
                'address' => 'Dietrich Forks Apt. 506, Sidakarya',
                'district' => 'Denpasar Selatan',
                'latitude' => -8.701500,
                'longitude' => 115.228500,
                'is_verified' => true,
                'price_start' => 900000,
                'thumbnail' => 'https://placehold.co/600x400?text=Kos+Sidakarya',
                'rooms' => [
                    [
                        'type' => 'Economy', 
                        'price' => 900000, 
                        'size' => '3x3',
                        'facilities' => [
                            ['name' => 'WiFi', 'icon' => 'wifi'],
                            ['name' => 'Kasur', 'icon' => 'bed']
                        ]
                    ]
                ]
            ],
            [
                'id' => 3,
                'name' => 'Casper-O\'Reilly Gatsu',
                'description' => 'Strategis di area bisnis Gatsu Barat.',
                'address' => 'Jl. Willms Manor No. 590, Denpasar Utara',
                'district' => 'Denpasar Utara',
                'latitude' => -8.633684,
                'longitude' => 115.249074,
                'is_verified' => false,
                'price_start' => 1500000,
                'thumbnail' => 'https://placehold.co/600x400?text=Kos+Gatsu',
                'rooms' => [
                    [
                        'type' => 'Standard AC', 
                        'price' => 1500000, 
                        'size' => '3x4',
                        'facilities' => [
                            ['name' => 'AC', 'icon' => 'ac_unit'],
                            ['name' => 'WiFi', 'icon' => 'wifi'],
                            ['name' => 'Laundry', 'icon' => 'local_laundry_service']
                        ]
                    ]
                ]
            ],
            [
                'id' => 4,
                'name' => 'Barton-Ward Teuku Umar',
                'description' => 'Sangat dekat dengan pusat perbelanjaan dan kuliner.',
                'address' => 'Jl. Simonis Land No. 471, Denpasar Barat',
                'district' => 'Denpasar Barat',
                'latitude' => -8.675000,
                'longitude' => 115.200000,
                'is_verified' => true,
                'price_start' => 1800000,
                'thumbnail' => 'https://placehold.co/600x400?text=Kos+Teuku+Umar',
                'rooms' => [
                    [
                        'type' => 'Studio Suite', 
                        'price' => 1800000, 
                        'size' => '4x5',
                        'facilities' => [
                            ['name' => 'Full Furnished', 'icon' => 'chair'],
                            ['name' => 'AC', 'icon' => 'ac_unit'],
                            ['name' => 'Smart TV', 'icon' => 'tv']
                        ]
                    ]
                ]
            ],
            [
                'id' => 5,
                'name' => 'Eichmann Sanur Stay',
                'description' => 'Kos dengan nuansa villa dekat pantai Sanur.',
                'address' => 'Jl. Erling Mills No. 701, Sanur',
                'district' => 'Denpasar Selatan',
                'latitude' => -8.6748, 
                'longitude' => 115.2631,
                'is_verified' => true,
                'price_start' => 3000000,
                'thumbnail' => 'https://placehold.co/600x400?text=Kos+Sanur',
                'rooms' => [
                    [
                        'type' => 'Deluxe', 
                        'price' => 3000000, 
                        'size' => '5x5',
                        'facilities' => [
                            ['name' => 'Kolam Renang', 'icon' => 'pool'],
                            ['name' => 'Kitchenette', 'icon' => 'kitchen'],
                            ['name' => 'AC', 'icon' => 'ac_unit']
                        ]
                    ]
                ]
            ]
        ]
    ]);
});

Route::get('/mock-cultural-events', function () {
    return response()->json([
        'success' => true,
        'message' => 'Data Event Budaya & Kemacetan Denpasar (Simulation)',
        'data' => [
            [
                'id' => 101,
                'event_name' => 'Pawai Ogoh-ogoh (Pengerupukan)',
                'description' => 'Penutupan jalan total di sekitar Catur Muka.',
                'district' => 'Denpasar Utara',
                'latitude' => -8.6581, 
                'longitude' => 115.2163,
                'type' => 'road_closure', 
                'severity' => 'high'
            ],
            [
                'id' => 102,
                'event_name' => 'Upacara Melasti',
                'description' => 'Iring-iringan menuju Pantai Sanur. Bypass Ngurah Rai padat.',
                'district' => 'Denpasar Selatan',
                'latitude' => -8.6748, 
                'longitude' => 115.2631,
                'type' => 'traffic_warning',
                'severity' => 'medium'
            ]
        ]
    ]);
});