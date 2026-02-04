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
            $statusPayment = 'paid';   // Uang Masuk -> Masuk Laporan Keuangan
        } 
        else if ($transactionStatus == 'pending') {
            // User baru klik bayar / nunggu transfer
            $statusBooking = 'pending'; // Atau tetap 'approved'
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
            
            // Update Database
            $booking->update([
                'status' => $statusBooking,
                'payment_status' => $statusPayment
            ]);

            // --- LOGIC NOTIFIKASI ---
            // Jika pembayaran BERHASIL (Paid), beri tahu Tenant
            if ($statusPayment == 'paid') {
                try {
                    // Notif ke Tenant: "Pembayaran Berhasil! Selamat datang..."
                    $booking->tenant->notify(new BookingStatusNotification($booking, 'active'));
                    
                    Log::info("Notifikasi pembayaran sukses dikirim ke user ID: " . $booking->tenant->id);
                } catch (\Exception $e) {
                    Log::error("Gagal mengirim notifikasi: " . $e->getMessage());
                }
            }
            // Jika pembayaran GAGAL/EXPIRED
            else if ($statusPayment == 'failed' || $statusPayment == 'expired') {
                try {
                    $booking->tenant->notify(new BookingStatusNotification($booking, 'rejected')); // Atau buat status baru 'failed'
                } catch (\Exception $e) {}
            }
        }

        // 6. Return OK biar Midtrans gak ngirim notif berulang-ulang
        return response()->json(['message' => 'Callback received successfully']);
    }
}