<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Booking; // Jangan lupa import Model Booking!
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * 1. MELIHAT REVIEW (PUBLIC)
     * - Menampilkan list komentar
     * - Menampilkan rangkuman rating (Rata-rata & Total)
     */
    public function index($kost_id)
    {
        // A. Ambil Data Review dari Database
        $reviews = Review::where('kost_id', $kost_id)
                    // Ambil data user spesifik biar hemat bandwidth
                    ->with('user:id,name,role,avatar') 
                    ->latest() // Urutkan dari yang paling baru
                    ->get();

        // B. Hitung Statistik 
        $summary = [
            'average_rating' => round($reviews->avg('rating'), 1), // Contoh: 4.5
            'total_reviews'  => $reviews->count(),                 // Contoh: 50
            'star_counts'    => [
                '5_star' => $reviews->where('rating', 5)->count(),
                '4_star' => $reviews->where('rating', 4)->count(),
                '3_star' => $reviews->where('rating', 3)->count(),
                '2_star' => $reviews->where('rating', 2)->count(),
                '1_star' => $reviews->where('rating', 1)->count(),
            ]
        ];

        return response()->json([
            'success' => true,
            'summary' => $summary, // Data Rangkuman
            'data'    => $reviews  // Data List Komentar
        ]);
    }

    /**
     * 2. MENULIS REVIEW (PERLU LOGIN)
     * - Cek apakah user pernah ngekos disitu (Status Finished)
     * - Cek apakah user sudah pernah review sebelumnya (Anti Spam)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'kost_id' => 'required|exists:kosts,id',
            'rating'  => 'required|integer|min:1|max:5', // Bintang 1 - 5
            'comment' => 'nullable|string|max:500',       // Komentar opsional
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $request->user();
        $kostId = $request->kost_id;

        // 2. SECURITY CHECK: Apakah user ini penyewa asli?
        // Syarat: Ada di tabel bookings, statusnya 'finished', dan room-nya milik kos ini.
        $isRealTenant = Booking::where('user_id', $user->id)
            ->where('status', 'finished') // WAJIB SUDAH SELESAI
            ->whereHas('room', function ($query) use ($kostId) {
                $query->where('kost_id', $kostId);
            })
            ->exists();

        if (!$isRealTenant) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal! Anda belum menyelesaikan masa sewa di kos ini.'
            ], 403); // 403 Forbidden
        }

        // 3. SPAM CHECK: Apakah sudah pernah review sebelumnya?
        $alreadyReviewed = Review::where('user_id', $user->id)
            ->where('kost_id', $kostId)
            ->exists();

        if ($alreadyReviewed) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memberikan ulasan untuk kos ini.'
            ], 400); // 400 Bad Request
        }

        // 4. Simpan ke Database
        $review = Review::create([
            'user_id' => $user->id,
            'kost_id' => $kostId,
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Ulasan Anda berhasil dikirim.',
            'data'    => $review
        ], 201);
    }
}