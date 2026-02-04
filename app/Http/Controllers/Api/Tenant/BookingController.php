<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NewBookingNotification;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon; // Library untuk manipulasi tanggal


class BookingController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date|after_or_equal:today', // Gak boleh tanggal lampau
            'duration' => 'required|integer|min:1|max:12', // Sewa minimal 1 bulan, max 1 tahun (opsional)
        ]);
    
        // 2. Ambil Data Kamar (Cek Stok & Harga)
        $room = Room::findOrFail($request->room_id);

        // Cek apakah kamar penuh?
        if ($room->available_rooms < 1) {
            return response()->json(['message' => 'Maaf, kamar ini sudah penuh.'], 400);
        }

        // Cek apakah user ini SUDAH punya booking aktif/pending di kamar yang sama
        $existingBooking = Booking::where('user_id', $request->user()->id)
            ->where('room_id', $room->id)
            ->whereIn('status', ['pending', 'approved', 'active'])
            ->exists();

        if ($existingBooking) {
            return response()->json(['message' => 'Anda sudah memiliki pesanan aktif di kamar ini.'], 400);
        }

        // 3. Hitung Kalkulasi 
        $pricePerMonth = $room->price_per_month;
        $duration = $request->duration; 

        $totalPrice = $pricePerMonth * $duration; 
        
        // Hitung End Date
        // Contoh: Masuk 1 Jan + 1 Bulan = Keluar 1 Feb
        $startDate = Carbon::parse($request->start_date);
        $endDate = $startDate->copy()->addMonths($duration);

        // 4. Simpan ke Database
        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'room_id' => $room->id,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'total_price' => $totalPrice,
            'status' => 'pending', // Default menunggu owner
        ]);

        $owner = $booking->room->kost->owner;

        // Kirim Notif ke Owner
        $owner->notify(new NewBookingNotification($booking));

        return response()->json([
            'success' => true,
            'message' => 'Permintaan sewa berhasil dikirim! Tunggu konfirmasi pemilik kos.',
            'data' => $booking
        ]);
    }

    public function index(Request $request)
    {
        // Ambil semua booking milik user ini, urutkan dari yang terbaru
        $bookings = Booking::with(['room.kost']) // Load info kamar & kos
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }
}
