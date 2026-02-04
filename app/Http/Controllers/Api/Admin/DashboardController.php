<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kost;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. KOTAK: Perlu Verifikasi (Kost yang statusnya belum verified)
        $pendingKostCount = Kost::where('is_verified', false)->count();

        // 2. KOTAK: Total Properti (Semua kost yang terdaftar)
        $totalKostCount = Kost::count();

        // 3. KOTAK: Total Pengguna (Role Tenant & Owner)
        // Kita exclude admin biar datanya real user
        $totalUserCount = User::whereIn('role', ['owner', 'tenant'])->count();

        // 4. KOTAK: Estimasi Transaksi (Total duit masuk bulan ini)
        // Logika: Ambil semua booking yang status bayarnya 'paid' di bulan ini
        $currentMonthRevenue = Booking::where('payment_status', 'paid')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('total_price');

        // --- TAMBAHAN UNTUK GRAFIK / LIST ---
        // 5. Booking Terbaru (Untuk widget status sistem atau aktivitas)
        $recentBookings = Booking::with(['tenant', 'room.kost'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'widgets' => [
                    'pending_verification' => $pendingKostCount,
                    'total_properties' => $totalKostCount,
                    'total_users' => $totalUserCount,
                    'monthly_revenue' => $currentMonthRevenue
                ],
                'recent_activity' => $recentBookings
            ]
        ]);
    }
}