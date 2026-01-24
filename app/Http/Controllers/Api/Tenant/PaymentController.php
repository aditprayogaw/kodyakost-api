<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function getPaymentLink(Request $request, $id)
    {
        // 1. Cari Booking milik Tenant yang statusnya 'approved'
        $booking = Booking::with(['room.kost', 'tenant'])
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        // Validasi: Cuma boleh bayar kalau status approved
        if ($booking->status !== 'approved') {
            return response()->json(['message' => 'Booking belum disetujui atau status tidak valid.'], 400);
        }

        // 2. Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 3. Bikin ID Transaksi Unik
        // Gabung ID Booking + Timestamp biar kalau user coba bayar berkali-kali gak error "Duplicate Order ID"
        $orderId = 'BOOKING-' . $booking->id . '-' . time();

        // 4. Siapkan Parameter untuk dikirim ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->tenant->name,
                'email' => $booking->tenant->email,
                'phone' => $booking->tenant->phone_whatsapp,
            ],
            'item_details' => [
                [
                    'id' => 'ROOM-' . $booking->room->id,
                    'price' => (int) $booking->total_price,
                    'quantity' => 1,
                    'name' => 'Sewa ' . $booking->room->room_type . ' (' . $booking->room->kost->name . ')',
                ]
            ]
        ];

        try {
            // 5. Minta Snap Token ke Midtrans
            $snapToken = Snap::getSnapToken($params);
            
            return response()->json([
                'success' => true,
                'message' => 'Link pembayaran berhasil dibuat.',
                'data' => [
                    'booking_id' => $booking->id,
                    'order_id' => $orderId,
                    'amount' => $booking->total_price,
                    'snap_token' => $snapToken, // <--- INI HARTA KARUNNYA
                    'redirect_url' => 'https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $snapToken // Link bayar versi web
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal terhubung ke Midtrans: ' . $e->getMessage()], 500);
        }
    }
}
