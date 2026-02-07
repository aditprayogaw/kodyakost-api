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
        $query = Kost::with('rooms.facilities', 'rooms.images', 'user')
            ->withAvg('reviews', 'rating') // Menghasilkan field: reviews_avg_rating
            ->withCount('reviews')         // Menghasilkan field: reviews_count
            ->where('is_verified', true);

        // 2. Search berdasarkan Nama Kos atau Alamat (Pencarian Kata Kunci)
        if ($request->has('search')) {
            $search = $request->query('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('village', 'like', "%{$search}%");
            });
        }

        // 3. Filter berdasarkan district jika ada di query params
        if ($request->has('district')) {
            $query->where('district', $request->query('district'));
        }

        // 4. Filter berdasarkan Range Harga (Price Range)
        // Mencari kos yang memiliki kamar di rentang harga tertentu
        if ($request->has('min_price') || $request->has('max_price')) {
            $query->whereHas('rooms', function($q) use ($request) {
                if ($request->has('min_price')) {
                    $q->where('price_per_month', '>=', $request->query('min_price'));
                }
                if ($request->has('max_price')) {
                    $q->where('price_per_month', '<=', $request->query('max_price'));
                }
            });
        }

        // 5. Filter berdasarkan Fasilitas Kamar
        if ($request->has('facilities')) {
            // contoh: ?facilities[]=1&facilities[]=2
            $facilityIds = $request->query('facilities');

            $query->whereHas('rooms.facilities', function($q) use ($facilityIds) {
                $q->whereIn('facilities.id', $facilityIds);
            });
        }

        // 6. Sorting: Verified pertama, lalu terbaru
        $kosts = $query->orderBy('is_verified', 'desc')->latest()->get();

        return KostResource::collection($kosts);
    }

    public function show($id)
    {
        $kost = Kost::with('rooms.images', 'rooms.facilities', 'user')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->findOrFail($id);

        $kost->increment('views');
        
        return new KostResource($kost);
    }
}
