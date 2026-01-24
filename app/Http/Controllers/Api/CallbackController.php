<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;  // Track error


class CallbackController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        
        // 1. Ambil data JSON dari Midtrans
        $json = $request->getContent();
        $notification = json_decode($json);

        // Validasi payload
        if (!$notification) {
            return response()->json(['message' => 'Invalid JSON'], 400);
        }

        $transactionStatus = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        // 2. Logika Parse Order ID
        // Format Order ID kita: "BOOKING-15-173829102"
        // Kita butuh angka "15" (ID Booking aslinya)
        $parts = explode('-', $orderId);
        $bookingId = $parts[1]; // Ambil elemen ke-2

        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // 3. Validasi Security (Signature Key)
        // Rumus Midtrans: SHA512(order_id + status_code + gross_amount + ServerKey)
        // $input = $orderId . $notification->status_code . $notification->gross_amount . $serverKey;
        // $signature = openssl_digest($input, 'sha512');

        // if ($signature !== $notification->signature_key) {
        //     return response()->json(['message' => 'Invalid Signature'], 403);
        // }

        // 4. Update Status Berdasarkan Laporan Midtrans
        if ($transactionStatus == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $booking->update(['status' => 'pending']); // Masih dicek bank
                } else {
                    $booking->update(['status' => 'active']); // Sukses CC
                }
            }
        } else if ($transactionStatus == 'settlement') {
            // INI YANG PALING PENTING (Transfer Bank / VA / E-Wallet sukses)
            $booking->update(['status' => 'active']);
            
        } else if ($transactionStatus == 'pending') {
            $booking->update(['status' => 'pending']); // Menunggu bayar
            
        } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $booking->update(['status' => 'canceled']); // Gagal / Kadaluarsa
        }

        return response()->json(['message' => 'Callback received successfully']);
    }
}
