<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class MyKostController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Cari booking milik user ini yang statusnya 'active'
        // Kita gunakan 'with' untuk mengambil data Kamar dan data Kost sekaligus
        $activeBooking = Booking::with(['room.kost.owner'])
            ->where('user_id', $user->id)
            ->where('status', 'active')
            // Ambil yang end_date nya belum lewat hari ini
            ->where('end_date', '>=', now()->toDateString())
            ->first();

        if (!$activeBooking) {
            return response()->json([
                'message' => 'Anda tidak memiliki kost aktif saat ini.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data kos aktif ditemukan.',
            'data' => [
                'booking_id' => $activeBooking->id,
                'status' => 'Active Tenant',
                'check_in' => $activeBooking->start_date,
                'check_out' => $activeBooking->end_date,
                'kost_name' => $activeBooking->room->kost->name,
                'kost_address' => $activeBooking->room->kost->address,
                'room_type' => $activeBooking->room->room_type,
                'owner_name' => $activeBooking->room->kost->owner->name,
                'owner_phone' => $activeBooking->room->kost->owner->phone_whatsapp, 
                'google_maps' => "https://www.google.com/maps?q={$activeBooking->room->kost->latitude},{$activeBooking->room->kost->longitude}",
                // Nantinya setelah ini menambahkan info pembayaran, dsb
            ]
        ]);
    }
}
