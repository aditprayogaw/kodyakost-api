<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Log; 
use App\Notifications\BookingStatusNotification;

class CallbackController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        // 1. Ambil Payload dari Midtrans
        $payload = $request->getContent();
        $notification = json_decode($payload);

        // Validasi JSON
        if (!$notification) {
            return response()->json(['message' => 'Invalid JSON'], 400);
        }

        // 2. Ambil Variable Penting
        $transactionStatus = $notification->transaction_status; 
        $type = $notification->payment_type;
        $orderId = $notification->order_id; // Contoh: BOOKING-15-1738...
        $fraud = $notification->fraud_status;

        // 3. Parse Order ID buat dapet Booking ID
        // Format: "BOOKING-{id}-{timestamp}" -> Ambil angka tengah
        $parts = explode('-', $orderId);
        
        // Jaga-jaga kalau format order_id salah
        if (count($parts) < 2) {
             return response()->json(['message' => 'Invalid Order ID Format'], 400);
        }
        
        $bookingId = $parts[1]; 
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Simpan status lama untuk pengecekan double-update
        $oldPaymentStatus = $booking->payment_status;

        // 4. LOGIKA UPDATE STATUS (SINKRONISASI DATABASE)
        // Kita siapkan variable status untuk di-update
        $statusBooking = null;
        $statusPayment = null;

        if ($transactionStatus == 'capture') {
            // Khusus Kartu Kredit
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $statusBooking = 'pending';
                    $statusPayment = 'unpaid'; // Masih ditahan bank
                } else {
                    $statusBooking = 'active'; // Transaksi Sukses
                    $statusPayment = 'paid';   // Uang Masuk
                }
            }
        } 
        else if ($transactionStatus == 'settlement') {
            // INI YANG PALING SERING (Transfer Bank, Gopay, Indomaret sukses)
            $statusBooking = 'active'; // Booking Sah
            $statusPayment = 'paid';   // Uang Masuk
        } 
        else if ($transactionStatus == 'pending') {
            // User baru klik bayar / nunggu transfer
            $statusBooking = 'pending'; 
            $statusPayment = 'unpaid';
        } 
        else if ($transactionStatus == 'deny') {
            // Ditolak bank
            $statusBooking = 'canceled';
            $statusPayment = 'failed';
        } 
        else if ($transactionStatus == 'expire') {
            // Telat bayar
            $statusBooking = 'canceled';
            $statusPayment = 'expired';
        } 
        else if ($transactionStatus == 'cancel') {
            // Dibatalkan manual
            $statusBooking = 'canceled';
            $statusPayment = 'failed';
        }

        // 5. SIMPAN KE DATABASE & KIRIM NOTIFIKASI
        if ($statusBooking && $statusPayment) {
            
            // Update Database Utama
            $booking->update([
                'status' => $statusBooking,
                'payment_status' => $statusPayment
            ]);

            // --- [LOGIKA PENGURANGAN STOK KAMAR] ---
            // Cek: Apakah status sekarang 'paid' DAN status sebelumnya BELUM 'paid'?
            // Ini untuk mencegah stok berkurang 2x kalau Midtrans kirim notif double.
            if ($statusPayment == 'paid' && $oldPaymentStatus != 'paid') {
                try {
                    $room = $booking->room;

                    if ($room) {
                        // Kurangi stok kamar otomatis -1
                        $room->decrement('available_rooms');
                        Log::info("✅ Stok kamar ID {$room->id} berhasil dikurangi. Sisa: " . ($room->available_rooms));
                    } else {
                        Log::warning("⚠️ Booking ID {$booking->id} lunas, tapi data kamar tidak ditemukan.");
                    }
                } catch (\Exception $e) {
                    Log::error("❌ Gagal mengurangi stok kamar: " . $e->getMessage());
                }
            }

            // --- LOGIC NOTIFIKASI ---
            if ($statusPayment == 'paid') {
                try {
                    // Notif ke Tenant
                    $booking->tenant->notify(new BookingStatusNotification($booking, 'active'));
                    Log::info("Notifikasi sukses dikirim ke user ID: " . $booking->tenant->id);
                } catch (\Exception $e) {
                    Log::error("Gagal mengirim notifikasi: " . $e->getMessage());
                }
            }
            else if ($statusPayment == 'failed' || $statusPayment == 'expired') {
                try {
                    $booking->tenant->notify(new BookingStatusNotification($booking, 'rejected'));
                } catch (\Exception $e) {}
            }
        }

        // 6. Return OK biar Midtrans gak ngirim notif berulang-ulang
        return response()->json(['message' => 'Callback received successfully']);
    }
}