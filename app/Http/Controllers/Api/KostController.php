<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kost;
use App\Http\Resources\KostResource;

class KostController extends Controller
{
    public function index(Request $request)
    {   
        // 1. Mulai query dengan eager loading
        $query = Kost::with('rooms.facilities', 'rooms.images', 'user')->where('is_verified', true);

        // --- FITUR: SORTING ---
        // Mengurutkan berdasarkan status verifikasi (true dulu), 
        // lalu berdasarkan tanggal dibuat (terbaru di atas)
        $query->orderBy('is_verified', 'desc')->latest();

        // 2. Filter berdasarkan district jika ada di query params
        if ($request->has('district')) {
            $query->where('district', $request->query('district'));
        }

        // 3. Ambil hasil query
        $kosts = $query->get();

        return KostResource::collection($kosts);
    }

    public function show($id)
    {
        $kost = Kost::with('rooms.images', 'rooms.facilities', 'user')->findOrFail($id);
        return new KostResource($kost);
    }
}
