<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kost;

class KostController extends Controller
{
    // 1. Lihat daftar kos yang statusnya 'Pending' (Belum verified)
    public function pending()
    {
        $kosts = Kost::with('owner')
            ->where('is_verified', false)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $kosts
        ]);
    }

    // 2. Verifikasi kos
    public function verify($id)
    {
        $kost = Kost::findOrFail($id);

        $kost->update([
            'is_verified' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kost berhasil diverifikasi',
            'data' => $kost
        ]);
    }
}
