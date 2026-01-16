<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\KostResource;

class WishlistController extends Controller
{
    // Menampilkan daftar kos yang ada di wishlist user
    public function index(Request $request)
    {
        $user = $request->user();
        $favorites = $user->wishlists()->with('rooms.images', 'rooms.facilities')->get();

        return response()->json([
            'success' => true,
            'data' => KostResource::collection($favorites)
        ]);
    }

    // Fitur menambahkan atau menghapus kos dari wishlist
    public function toggle(Request $request)
    {
        $request->validate([
            'kost_id' => 'required|exists:kosts,id'
        ]);

        $user = $request->user();
        $kostId = $request->kost_id;

        $result = $user->wishlists()->toggle($kostId);

        $status = count($result['attached']) > 0 ? 'added' : 'removed';

        return response()->json([
            'success' => true,
            'message' => $status === 'added' ? 'Berhasil disimpan ke wishlist' : 'Dihapus dari wishlist',
            'status' => $status
        ]);
    }
}
