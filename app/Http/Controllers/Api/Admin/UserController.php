<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * 1. LIHAT SEMUA USER (Bisa Filter & Cari)
     * Contoh: GET /api/admin/users?role=owner&search=budi
     */
    public function index(Request $request)
    {
        $users = User::query();

        // Filter berdasarkan Role (jika ada parameter ?role=tenant)
        if ($request->has('role')) {
            $users->where('role', $request->role);
        }

        // Fitur Pencarian (Nama atau Email)
        if ($request->has('search')) {
            $search = $request->search;
            $users->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Urutkan dari yang terbaru & Pagination 10 per halaman
        $data = $users->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List Data User',
            'data'    => $data
        ]);
    }

    /**
     * 2. LIHAT DETAIL USER
     * Contoh: GET /api/admin/users/5
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $user
        ]);
    }

    /**
     * 3. HAPUS USER (BAN)
     * Contoh: DELETE /api/admin/users/5
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        if ($user->role === 'admin') {
            return response()->json(['message' => 'Anda tidak bisa menghapus sesama Admin!'], 403);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus (Banned).'
        ]);
    }
}
