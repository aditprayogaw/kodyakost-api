<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KostController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CulturalEventController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ProfileController;

use App\Http\Controllers\Api\Admin\KostController as AdminKostController;
use App\Http\Controllers\Api\Owner\KostController as OwnerKostController;
use App\Http\Controllers\Api\Owner\RoomController;

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
Route::get('/kosts/{id}', [KostController::class, 'show']);
Route::get('/facilities', [FacilityController::class, 'index']);
Route::get('/cultural-events', [CulturalEventController::class, 'index']);
Route::get('/kosts/{id}/reviews', [ReviewController::class, 'index']);


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

    // UPDATE PROFILE
    Route::post('/profile/update', [ProfileController::class, 'update']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Route Wishlist
    Route::get('/wishlists', [WishlistController::class, 'index']);
    Route::post('/wishlists/toggle', [WishlistController::class, 'toggle']);

    // Kirim review
    Route::post('/reviews', [ReviewController::class, 'store']);
    /**
     * - Route untuk Booking (khusus tenant)
     * - Route untuk Approval (khusus owner)
     */
});

/*
| --------------------------------------------------------------------------
|   ROUTE ADMIN
| --------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'is_admin'])->prefix('admin')->group(function () {
    // Route Verify Kos
        Route::get('/kosts/pending', [AdminKostController::class, 'pending']);
        Route::patch('/kosts/{id}/verify', [AdminKostController::class, 'verify']);
});

/*
| --------------------------------------------------------------------------
|   ROUTE OWNER
| --------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'is_owner'])->prefix('owner')->group(function () {
    // CRUD KOST
    Route::get('/kosts', [OwnerKostController::class, 'index']); 
    Route::post('/kosts', [OwnerKostController::class, 'store']); 
    Route::put('/kosts/{id}', [OwnerKostController::class, 'update']); 
    Route::delete('/kosts/{id}', [OwnerKostController::class, 'destroy']);

    // CRUD KAMAR
    Route::get('/rooms', [RoomController::class, 'index']); 
    Route::post('/rooms', [RoomController::class, 'store']); 
    Route::put('/rooms/{id}', [RoomController::class, 'update']); 
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);
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