<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 1. Ambil tanggal hari ini (tengah malam)
        $today = Carbon::now()->startOfDay();

        // 2. Cari Booking yang:
        // - Statusnya masih 'active' (belum di-finish)
        // - Tanggal selesai (end_date) kurang dari hari ini (kemarin atau sebelumnya)
        $expiredBookings = Booking::where('status', 'active')
            ->whereDate('end_date', '<', $today)
            ->get();

        $count = 0;

        foreach ($expiredBookings as $booking) {
            try {
                // A. Ubah status booking jadi 'finished'
                $booking->update(['status' => 'finished']);

                // B. Ambil Room terkait
                $room = $booking->room;

                if ($room) {
                    // C. LOGIC GUARD: Cek dulu biar gak kebablasan
                    // Hanya tambah stok jika stok sekarang < total kamar
                    if ($room->available_rooms < $room->total_rooms) {
                        $room->increment('available_rooms');
                        Log::info("Auto-Restock: Kamar ID {$room->id} dikembalikan karena booking ID {$booking->id} selesai.");
                    } else {
                        Log::warning("Auto-Restock Skip: Kamar ID {$room->id} sudah penuh (Available: {$room->available_rooms}, Total: {$room->total_rooms}). Cek data!");
                    }
                }
                
                $count++;

            } catch (\Exception $e) {
                Log::error("Gagal memproses expired booking ID {$booking->id}: " . $e->getMessage());
            }
        }

        $this->info("Berhasil memproses {$count} booking yang expired.");
    }
}
