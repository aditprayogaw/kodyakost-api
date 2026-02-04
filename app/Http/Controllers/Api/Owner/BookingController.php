<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\BookingStatusNotification;
use App\Models\Booking;
use App\Models\Room;

class BookingController extends Controller
{
    // 1. MELIHAT DAFTAR BOOKING MASUK
    public function index(Request $request)
    {
        // Owner ID
        $ownerId = $request->user()->id;

        $bookings = Booking::with(['tenant', 'room.kost']) 
            // Query: Ambil booking yang kamarnya milik Owner ini
            ->whereHas('room.kost', function ($query) use ($ownerId) {
                $query->where('user_id', $ownerId);
            })
            ->latest() 
            ->get();

        // Keterangan:
        // Karena di Model User sudah ada 'appends' => ['ktp_url'],
        // Maka di data 'tenant' otomatis akan ada URL KTP-nya.
        // Frontend tinggal panggil: booking.tenant.ktp_url

        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    // 2. APPROVE ATAU REJECT BOOKING
    public function update(Request $request, $id)
    {
        // Validasi: Status hanya boleh 'approved' (Terima) atau 'rejected' (Tolak)
        // 'canceled' biasanya dilakukan oleh Tenant sendiri.
        $request->validate([
            'status' => 'required|in:approved,rejected' 
        ]);

        // Cari Booking milik Owner
        $booking = Booking::where('id', $id)
            ->whereHas('room.kost', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            })
            ->firstOrFail();

        // Logic Update Status
        $booking->status = $request->status;
        
        // Note: Payment Status biarkan apa adanya (unpaid). 
        // Setelah 'approved', nanti Tenant lanjut bayar via Midtrans.
        
        $booking->save();

        // Kirim Notif ke Tenant
        $booking->tenant->notify(new BookingStatusNotification($booking, $request->status));

        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diperbarui menjadi ' . $request->status,
            'data' => $booking
        ]);
    }

    
}
