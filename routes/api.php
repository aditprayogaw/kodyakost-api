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
use App\Http\Controllers\Api\CallbackController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Api\Admin\KostController as AdminKostController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\CulturalEventController as AdminCulturalEventController;

// OWNER CONTROLLERS
use App\Http\Controllers\Api\Owner\KostController as OwnerKostController;
use App\Http\Controllers\Api\Owner\BookingController as OwnerBookingController;
use App\Http\Controllers\Api\Owner\RoomController;

// TENANT CONTROLLERS
use App\Http\Controllers\Api\Tenant\MyKostController;
use App\Http\Controllers\Api\Tenant\BookingController as TenantBookingController;
use App\Http\Controllers\Api\Tenant\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes - KodyaKost Project
|--------------------------------------------------------------------------
*/

/*
| AUTHENTICATION 
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/*
| PUBLIC DATA 
*/
Route::get('/kosts', [KostController::class, 'index']);
Route::get('/kosts/{id}', [KostController::class, 'show']);
Route::get('/facilities', [FacilityController::class, 'index']);
Route::get('/cultural-events', [CulturalEventController::class, 'index']);
Route::get('/kosts/{id}/reviews', [ReviewController::class, 'index']);


/*
| PROTECTED ROUTES 
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
    // Logout: Menghapus token dari database
    Route::post('/logout', [AuthController::class, 'logout']);
    // Route Verify Kos
    Route::get('/kosts/pending', [AdminKostController::class, 'pending']);
    Route::patch('/kosts/{id}/verify', [AdminKostController::class, 'verify']);

    // --- MANAJEMEN USER ---
    Route::get('/users', [UserController::class, 'index']);      // List User
    Route::get('/users/{id}', [UserController::class, 'show']);  // Detail User
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Hapus User

    // --- Cultural Event Management ---
    Route::get('/events', [AdminCulturalEventController::class, 'index']);
    Route::post('/events', [AdminCulturalEventController::class, 'store']);       // Create 
    Route::post('/events/{id}', [AdminCulturalEventController::class, 'update']); // Update 
    Route::delete('/events/{id}', [AdminCulturalEventController::class, 'destroy']); // Delete
});

/*
| --------------------------------------------------------------------------
|   ROUTE OWNER
| --------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'is_owner'])->prefix('owner')->group(function () {
    // Logout: Menghapus token dari database
    Route::post('/logout', [AuthController::class, 'logout']);
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

    // Manage Bookings
    Route::get('/bookings', [OwnerBookingController::class, 'index']); // List Pesanan
    Route::patch('/bookings/{id}', [OwnerBookingController::class, 'update']); // Approve/Reject
});

/*
| --------------------------------------------------------------------------
|   ROUTE TENANT
| --------------------------------------------------------------------------
*/

// --- GROUP KHUSUS TENANT ---
Route::middleware(['auth:sanctum'])->prefix('tenant')->group(function () {
    
    // Fitur "Active Mode" (Kos Saya)
    Route::get('/my-kost', [MyKostController::class, 'index']);
    // Request Booking
    Route::post('/bookings', [TenantBookingController::class, 'store']);
    Route::get('/bookings', [TenantBookingController::class, 'index']);
    // Payment Gateway
    Route::get('/bookings/{id}/payment', [PaymentController::class, 'getPaymentLink']);
});

// Midtrans Callback (Webhook)
// Method POST karena Midtrans ngirim data
Route::post('/midtrans/callback', [CallbackController::class, 'handle']);


