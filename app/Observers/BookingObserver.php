<?php

namespace App\Observers;

use App\Models\Booking;

class BookingObserver
{
    /**
     * Handle the Booking "updated" event.
     * Dijalankan otomatis setiap kali ada booking yang di-update (termasuk saat Callback Midtrans).
     */
    public function updated(Booking $booking)
    {
        // SKENARIO 1: PENGURANGAN STOK (Saat User Bayar Lunas)
        // Jika status pembayaran berubah jadi 'paid'
        if ($booking->wasChanged('payment_status') && $booking->payment_status == 'paid') {
            $room = $booking->room;
            
            // Pastikan stok tidak negatif
            if ($room->available_rooms > 0) {
                $room->decrement('available_rooms'); 
            }
        }

        // SKENARIO 2: PENGEMBALIAN STOK (Saat Cancel / Reject / Expired)
        // Jika status berubah jadi 'canceled', 'rejected', atau 'expired'
        // DAN sebelumnya dia sudah pernah bayar (stok udah kepotong), maka balikin stoknya.
        if ($booking->wasChanged('status') && in_array($booking->status, ['canceled', 'rejected'])) {
            // Cek apakah user ini tadinya sudah status 'paid'/'active'?
            // Kalau dia belum bayar (masih pending) lalu cancel, stok gak perlu dibalikin (karena belum dipotong)
            // Tapi kalau kasusnya refund atau cancel paksa setelah bayar:
            if ($booking->payment_status == 'paid') {
                $booking->room->increment('available_rooms');
            }
        }
        
        // Catatan: Untuk status 'finished' (Selesai ngekos), kita handle via Scheduler (Otomatis tiap hari)
        // karena status 'finished' itu berdasarkan waktu, bukan klik tombol.
    }
}