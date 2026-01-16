<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    // 1. Menulis Review Baru (Perlu Login)
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kost_id' => 'required|exists:kosts,id',
            'rating'  => 'required|integer|min:1|max:5', // Bintang 1 sampai 5
            'comment' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Simpan ke database
        // Nanti saat Booking System jadi, kita akan tambah cek:
        // "Apakah user ini pernah booking di kos ini?"
        
        $review = Review::create([
            'user_id' => $request->user()->id,
            'kost_id' => $request->kost_id,
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review berhasil dikirim',
            'data'    => $review
        ], 201);
    }

    // 2. Melihat Review per Kos (Public - Tidak perlu login)
    public function index($kost_id)
    {
        // Ambil review berdasarkan kost_id, urutkan dari terbaru
        // Include data user (nama & avatar) biar kelihatan siapa yg review
        $reviews = Review::where('kost_id', $kost_id)
                    ->with('user:id,name,avatar') 
                    ->latest()
                    ->get();

        return response()->json([
            'success' => true,
            'data'    => $reviews
        ]);
    }
}
