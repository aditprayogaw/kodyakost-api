<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;

class BookingController extends Controller
{
    // 1. Melihat daftar booking untuk kost milik owner yang sedang login
    public function index(Request $request)
    {
        // Logika Query:
        // Ambil Booking -> Relasi Room -> Relasi Kost -> Cek user_id (Owner)
        $bookings = Booking::with(['tenant', 'room.kost']) // Load data penyewa & info kamar
            ->whereHas('room.kost', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            })
            ->latest() // Yang baru masuk paling atas
            ->get();

        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    // 2. Approve atau Reject booking
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,canceled' 
        ]);

        // Pastikan Booking ini valid dan memang untuk kos milik owner ini
        $booking = Booking::where('id', $id)
            ->whereHas('room.kost', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            })
            ->firstOrFail();

        // Update Status
        $booking->status = $request->status;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diperbarui menjadi ' . $request->status,
            'data' => $booking
        ]);
    }
}
