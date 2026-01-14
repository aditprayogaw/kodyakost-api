<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KostController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes - KodyaKost Project
|--------------------------------------------------------------------------
*/

/*
| 1. AUTHENTICATION 
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/*
| 2. PUBLIC DATA 
*/
Route::get('/kosts', [KostController::class, 'index']);


/*
| 3. PROTECTED ROUTES 
*/
Route::middleware('auth:sanctum')->group(function () {
    
    // Logout: Menghapus token dari database
    Route::post('/logout', [AuthController::class, 'logout']);

    // Get Profile: Mengambil data user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /**
     * Kedepannya di sini kita akan pasang:
     * - Route untuk Booking (khusus tenant)
     * - Route untuk Approval (khusus owner)
     */
});

/*
|--------------------------------------------------------------------------
| Mock API KodyaKost - Update 14 Jan 2026
|--------------------------------------------------------------------------
*/

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