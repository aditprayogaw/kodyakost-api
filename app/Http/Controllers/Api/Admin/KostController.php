<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kost;

class KostController extends Controller
{
    // 1. LIHAT SEMUA PENGAJUAN KOS (Yang statusnya belum verified)
    public function index(Request $request)
    {
        $query = Kost::with('owner'); // Load data pemiliknya juga

        if ($request->has('status') && $request->status == 'pending') {
            $query->where('is_verified', false);
        }

        $kosts = $query->orderBy('created_at', 'desc')->get();

        return response()->json(['success' => true, 'data' => $kosts]);
    }

    // 2. LIHAT DETAIL KOS 
    public function show($id)
    {
        $kost = Kost::with(['owner', 'rooms'])->find($id);
        
        if (!$kost) return response()->json(['message' => 'Kos tidak ditemukan'], 404);

        return response()->json(['success' => true, 'data' => $kost]);
    }

    // 3. APPROVE KOS (Verifikasi)
    public function approve($id)
    {
        $kost = Kost::find($id);
        if (!$kost) return response()->json(['message' => 'Kos tidak ditemukan'], 404);

        $kost->update(['is_verified' => true]);

        return response()->json([
            'success' => true, 
            'message' => 'Kos berhasil disetujui dan sekarang live di publik!'
        ]);
    }

    // 4. REJECT KOS 
    public function reject($id)
    {
        $kost = Kost::find($id);
        if (!$kost) return response()->json(['message' => 'Kos tidak ditemukan'], 404);

        $kost->update(['is_verified' => false]);

        return response()->json([
            'success' => true, 
            'message' => 'Kos ditolak / dicabut verifikasinya.'
        ]);
    }
}