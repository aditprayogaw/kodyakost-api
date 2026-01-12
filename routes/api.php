<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes - KodyaKost Project
|--------------------------------------------------------------------------
*/


/**
 * 1. AUTHENTICATION (REAL & PROTECTED)
 * Menggunakan Laravel Sanctum untuk keamanan asli.
 */

// Route Publik: Untuk pendaftaran dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route Terproteksi: Harus membawa Bearer Token
Route::middleware('auth:sanctum')->group(function () {
    
    // Ambil data profil user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Proses Logout (Hapus Token)
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Token berhasil dihapus, sesi berakhir.'
        ]);
    });
});

/**
 * 2. PROPERTI KOS (MOCK)
 * Endpoint untuk menampilkan List Kos dan Filter di Map
 */
Route::get('/mock-kosts', function () {
    return response()->json([
        'success' => true,
        'message' => 'Daftar Kos Denpasar dimuat',
        'data' => [
            [
                'id' => 1,
                'name' => 'Schmeler Kost Renon',
                'owner_id' => 2,
                'description' => 'Dekat dengan Monumen Bajra Sandhi, lingkungan tenang.',
                'address' => 'Jl. Anderson Wall No. 649, Renon',
                'district' => 'Denpasar Timur',
                'village' => 'Renon',
                'latitude' => -8.679419,
                'longitude' => 115.23613,
                'is_verified' => true,
                'price_start' => 1200000,
                'thumbnail' => 'https://placehold.co/600x400?text=Kos+Renon',
                'rooms' => [
                    ['type' => 'Standard', 'price' => 1200000, 'size' => '3x3', 'status' => 'available'],
                    ['type' => 'VIP', 'price' => 2500000, 'size' => '4x4', 'status' => 'full'],
                ]
            ],
            [
                'id' => 2,
                'name' => 'Ward-Prosacco Sidakarya',
                'owner_id' => 3,
                'description' => 'Akses mudah ke jalur Bypass Ngurah Rai.',
                'address' => 'Dietrich Forks Apt. 506, Sidakarya',
                'district' => 'Denpasar Selatan',
                'village' => 'Sidakarya',
                'latitude' => -8.701500, // Koordinat disesuaikan ke arah selatan
                'longitude' => 115.228500,
                'is_verified' => true,
                'price_start' => 900000,
                'thumbnail' => 'https://placehold.co/600x400?text=Kos+Sidakarya',
                'rooms' => [
                    ['type' => 'Economy', 'price' => 900000, 'size' => '2x3', 'status' => 'available']
                ]
            ],
            [
                'id' => 3,
                'name' => 'Casper-O\'Reilly Gatsu',
                'owner_id' => 4,
                'description' => 'Dekat area perkantoran Gatsu Tengah.',
                'address' => 'Jl. Willms Manor No. 590, Denpasar Utara',
                'district' => 'Denpasar Utara',
                'village' => 'Dauh Puri Kaja',
                'latitude' => -8.633684,
                'longitude' => 115.249074,
                'is_verified' => false,
                'price_start' => 1500000,
                'thumbnail' => 'https://placehold.co/600x400?text=Kos+Gatsu',
                'rooms' => [
                    ['type' => 'Standard AC', 'price' => 1500000, 'size' => '3x4', 'status' => 'available']
                ]
            ]
        ]
    ]);
});

/**
 * 3. CULTURAL EVENTS & TRAFFIC (MOCK) - FITUR UNGGULAN
 * Endpoint untuk integrasi Google Maps & Kalender Bali
 */
Route::get('/mock-cultural-events', function () {
    return response()->json([
        'success' => true,
        'message' => 'Data Event Budaya & Kemacetan Denpasar',
        'data' => [
            [
                'id' => 101,
                'event_name' => 'Pawai Ogoh-ogoh (Pengerupukan)',
                'description' => 'Penutupan jalan total di sekitar Catur Muka mulai jam 16.00 WITA.',
                'district' => 'Denpasar Utara',
                'latitude' => -8.6581, 
                'longitude' => 115.2163,
                'type' => 'road_closure', // road_closure | traffic_warning
                'severity' => 'high', // high | medium | low
                'start_time' => '2026-03-20 16:00:00',
                'end_time' => '2026-03-21 06:00:00',
            ],
            [
                'id' => 102,
                'event_name' => 'Upacara Melasti',
                'description' => 'Iring-iringan menuju Pantai Sanur. Jalur Bypass Ngurah Rai padat merayap.',
                'district' => 'Denpasar Selatan',
                'latitude' => -8.6748, 
                'longitude' => 115.2631,
                'type' => 'traffic_warning',
                'severity' => 'medium',
                'start_time' => '2026-03-18 06:00:00',
                'end_time' => '2026-03-18 12:00:00',
            ]
        ]
    ]);
});