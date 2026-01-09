<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Endpoint Mock untuk Frontend
Route::get('/mock-kosts', function () {
    return response()->json([
        'success' => true,
        'message' => '5 Data simulasi KodyaKost untuk pengembangan Frontend',
        'data' => [
            [
                'id' => 1,
                'name' => 'Schmeler, Welch and Lynch Kost',
                'owner_id' => 2,
                'description' => 'Kos nyaman dengan fasilitas lengkap di pusat kota.',
                'address' => '649 Anderson Wall, Denpasar Selatan',
                'district' => 'Denpasar Selatan',
                'village' => 'Horacio Court',
                'latitude' => -8.679419,
                'longitude' => 115.23613,
                'is_verified' => true,
                'price_start' => 1200000,
                'rooms' => [
                    ['type' => 'Standard', 'price' => 1200000, 'size' => '3x3'],
                    ['type' => 'VIP', 'price' => 2500000, 'size' => '4x4'],
                ]
            ],
            [
                'id' => 2,
                'name' => 'Ward-Prosacco Kost',
                'owner_id' => 3,
                'description' => 'Dekat dengan area kampus dan perkantoran.',
                'address' => '5635 Dietrich Forks Apt. 506, Denpasar Utara',
                'district' => 'Denpasar Utara',
                'village' => 'Sanford Groves',
                'latitude' => -8.633684,
                'longitude' => 115.249074,
                'is_verified' => true,
                'price_start' => 900000,
                'rooms' => [
                    ['type' => 'Economy', 'price' => 900000, 'size' => '2x3']
                ]
            ],
            [
                'id' => 3,
                'name' => 'Casper-O\'Reilly Kost',
                'owner_id' => 4,
                'description' => 'Lingkungan asri dan tenang di timur Denpasar.',
                'address' => '590 Willms Manor, Denpasar Timur',
                'district' => 'Denpasar Timur',
                'village' => 'Buckridge Plain',
                'latitude' => -8.711877,
                'longitude' => 115.243267,
                'is_verified' => true,
                'price_start' => 1500000,
                'rooms' => [
                    ['type' => 'Standard AC', 'price' => 1500000, 'size' => '3x4']
                ]
            ],
            [
                'id' => 4,
                'name' => 'Barton-Ward Kost',
                'owner_id' => 5,
                'description' => 'Akses mudah ke pusat perbelanjaan.',
                'address' => '471 Simonis Land, Denpasar Utara',
                'district' => 'Denpasar Utara',
                'village' => 'Doug Plains',
                'latitude' => -8.698182,
                'longitude' => 115.191416,
                'is_verified' => true,
                'price_start' => 1100000,
                'rooms' => [
                    ['type' => 'Reguler', 'price' => 1100000, 'size' => '3x3']
                ]
            ],
            [
                'id' => 5,
                'name' => 'Eichmann, Hill and Quitzon Kost',
                'owner_id' => 6,
                'description' => 'Strategis di area Teuku Umar.',
                'address' => '701 Bo Square, Denpasar Barat',
                'district' => 'Denpasar Barat',
                'village' => 'Erling Mills',
                'latitude' => -8.622208,
                'longitude' => 115.186332,
                'is_verified' => false,
                'price_start' => 1800000,
                'rooms' => [
                    ['type' => 'Studio', 'price' => 1800000, 'size' => '4x5']
                ]
            ]
        ]
    ]);
});