<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{
    /**
     * DASHBOARD KEUANGAN OWNER
     * Menampilkan: Total Pendapatan, Statistik Grafik, dan Transaksi Masuk
     */
    public function index(Request $request)
    {
        $ownerId = $request->user()->id;
        $year = $request->get('year', date('Y')); // Default tahun sekarang
        $month = $request->get('month', date('m')); // Default bulan sekarang

        // 1. QUERY DASAR: Ambil booking milik Owner ini yang SUDAH BAYAR (Paid)
        // Kita abaikan status 'active'/'approved', kita fokus ke 'payment_status' = 'paid'
        $baseQuery = Booking::whereHas('room.kost', function ($q) use ($ownerId) {
            $q->where('user_id', $ownerId);
        })->where('payment_status', 'paid'); 

        // --- A. INCOME BULAN INI (Untuk Widget Dashboard) ---
        $thisMonthIncome = (clone $baseQuery)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('total_price');

        // --- B. INCOME TAHUN INI (Untuk Widget Dashboard) ---
        $thisYearIncome = (clone $baseQuery)
            ->whereYear('created_at', $year)
            ->sum('total_price');

        // --- C. DATA GRAFIK BULANAN (Chart.js) ---
        // Kita butuh data array [Jan, Feb, ..., Des]
        $monthlyStats = (clone $baseQuery)
            ->whereYear('created_at', $year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as total')
            )
            ->groupBy('month')
            ->pluck('total', 'month') // Hasil: [1 => 500000, 3 => 100000]
            ->toArray();

        // Rapikan Data Grafik (Isi bulan kosong dengan 0)
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $monthlyStats[$i] ?? 0; // Kalau bulan $i gak ada, isi 0
        }

        // --- D. RIWAYAT TRANSAKSI TERBARU (List) ---
        $recentTransactions = (clone $baseQuery)
            ->with(['tenant:id,name', 'room.kost:id,name']) // Load nama penyewa & kos
            ->orderBy('created_at', 'desc')
            ->limit(10) // Ambil 10 terakhir
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'period' => [
                    'year' => $year,
                    'month' => $month
                ],
                'summary' => [
                    'income_this_month' => (int) $thisMonthIncome,
                    'income_this_year' => (int) $thisYearIncome,
                ],
                'chart_data' => $chartData, // Array urut Jan-Des, siap pakai di Frontend
                'recent_transactions' => $recentTransactions
            ]
        ]);
    }
}