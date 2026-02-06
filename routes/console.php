<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Booking;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('sanctum:prune-expired')->dailyAt('02:00');

// Jalankan pengecekan setiap hari jam 00:01 malam
Schedule::call(function () {
    // Cari booking yang statusnya 'active' TAPI tanggal keluarnya sudah lewat (kemarin)
    $expiredBookings = Booking::where('status', 'active')
        ->where('end_date', '<', now())
        ->get();

    foreach ($expiredBookings as $booking) {
        // 1. Ubah status jadi finished
        $booking->update(['status' => 'finished']);

        // 2. Kembalikan stok kamar
        $booking->room->increment('available_count');
        
        // (Opsional) Kirim notifikasi ke Tenant: "Terima kasih sudah ngekos di sini!"
    }
})->dailyAt('00:01');
