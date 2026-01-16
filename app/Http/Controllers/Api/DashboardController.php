<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\User;
use App\Models\Booking;

class DashboardController extends Controller
{
    function index(Request $request)
    {
        $user = $request->user();

        // DASHBOARD ADMIN
        if ($user->role === 'admin') {
            return response()->json([
                'role' => 'admin',
                'stats' => [
                    'total_kosts' => Kost::count(),
                    'total_users' => User::count(),
                    'pending_verification' => Kost::where('is_verified', false)->count(),
                    // Menghitung sebaran kos per kecamatan untuk grafik
                    'kost_per_district' => Kost::selectRaw('district, count(*) as total')
                        ->groupBy('district')
                        ->get()
                ]
            ]);
        }

        // DASHBOARD OWNER
        if ($user->role === 'owner') {
            // Ambil kos yang dimiliki oleh user ini saja
            $myKosts = Kost::where('user_id', $user->id);
            
            return response()->json([
                'role' => 'owner',
                'stats' => [
                    'total_properties' => $myKosts->count(),
                    'total_views' => $myKosts->sum('views'),
                    'total_rooms' => $myKosts->with('rooms')->get()->pluck('rooms')->flatten()->count(),
                    // Nanti tambah ini pas booking jadi:
                    // 'new_bookings' => Booking::whereHas('room.kost', fn($q) => $q->where('owner_id', $user->id))->where('status', 'pending')->count()
                ],
            ]);
        }

        // DASHBOARD TENANT
        if ($user->role === 'tenant') {
            return response()->json([
                'role' => 'tenant',
                'message' => 'Selamat datang, ' . $user->name,
                'data' => [
                    'wishlist_count' => $user->wishlists()->count(),
                    'profile_status' => [
                        'has_phone' => !empty($user->phone_whatsapp),
                        'has_avatar' => !empty($user->avatar),
                    ]
                ]
                // Nanti di sini kita tambah riwayat booking
            ]);
        }
    }
}
