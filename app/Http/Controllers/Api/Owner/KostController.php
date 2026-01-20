<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kost;
use Illuminate\Support\Facades\Storage;

class KostController extends Controller
{
    // 1. LIHAT SEMUA KOS MILIK SAYA
    public function index(Request $request)
    {
        $kosts = Kost::where('user_id', $request->user()->id)->get();
        return response()->json(['success' => true, 'data' => $kosts]);
    }

    // 2. TAMBAH KOS BARU
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'district' => 'required|in:Denpasar Barat,Denpasar Timur,Denpasar Utara,Denpasar Selatan',
            'village' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        /// 2. Simpan Data
        $kost = new Kost();
        $kost->user_id = $request->user()->id; // Ambil ID Owner dari Token
        $kost->name = $request->name;
        $kost->description = $request->description;
        $kost->address = $request->address;
        $kost->district = $request->district;
        $kost->village = $request->village;
        $kost->latitude = $request->latitude;
        $kost->longitude = $request->longitude;

        // Default value
        $kost->is_verified = false;

        // Upload Thumbnail 
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('kost_thumbnails', 'public');
            $kost->thumbnail = $path;
        }

        $kost->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Kos berhasil dibuat! Selanjutnya silakan tambah Tipe Kamar.',
            'data' => $kost
        ]);
    }

    // 3. EDIT KOS
    public function update(Request $request, $id)
    {
        $kost = Kost::where('user_id', $request->user()->id)->findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'price_per_month' => 'sometimes|numeric',
            // ... validasi lain sesuai kebutuhan
        ]);

        $kost->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data kos berhasil diperbarui.',
            'data' => $kost
        ]);
    }

    // 4. HAPUS KOS
    public function destroy(Request $request, $id)
    {
        $kost = Kost::where('user_id', $request->user()->id)->findOrFail($id);
        
        // Hapus (otomatis kamar & booking terhapus jika settingan db cascade)
        $kost->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kos berhasil dihapus.'
        ]);
    }
}
