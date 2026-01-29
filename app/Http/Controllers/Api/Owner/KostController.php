<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kost;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

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
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'district' => 'required|in:Denpasar Barat,Denpasar Timur,Denpasar Utara,Denpasar Selatan', // Sesuaikan enum DB
            'village' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'thumbnail' => 'required|image|max:2048' // Wajib ada foto saat pertama buat
        ]);

        $kost = new Kost();
        $kost->user_id = $request->user()->id;
        $kost->name = $request->name;
        $kost->description = $request->description;
        $kost->address = $request->address;
        $kost->district = $request->district;
        $kost->village = $request->village;
        $kost->latitude = $request->latitude;
        $kost->longitude = $request->longitude;
        $kost->is_verified = false; // Default Pending

        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('kost_thumbnails', 'public');
            $kost->thumbnail = $path;
        }

        $kost->save();

        return response()->json([
            'success' => true,
            'message' => 'Kos berhasil dibuat! Menunggu verifikasi Admin.',
            'data' => $kost
        ], 201);
    }

    // 3. EDIT KOS (Fixed: Handle Image & Security)
    public function update(Request $request, $id)
    {
        $kost = Kost::where('user_id', $request->user()->id)->findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        // Logic Update Gambar (Hapus lama, Simpan baru)
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada
            if ($kost->thumbnail && Storage::disk('public')->exists($kost->thumbnail)) {
                Storage::disk('public')->delete($kost->thumbnail);
            }
            // Simpan baru
            $path = $request->file('thumbnail')->store('kost_thumbnails', 'public');
            $kost->thumbnail = $path;
        }

        // Update data text
        $kost->update($request->except(['thumbnail', 'is_verified', 'user_id']));

        return response()->json([
            'success' => true,
            'message' => 'Data kos berhasil diperbarui.',
            'data' => $kost
        ]);
    }

    // 4. HAPUS KOS (Fixed: Hapus File Gambar)
    public function destroy(Request $request, $id)
    {
        $kost = Kost::where('user_id', $request->user()->id)->findOrFail($id);
        
        // Hapus file gambar dari server
        if ($kost->thumbnail && Storage::disk('public')->exists($kost->thumbnail)) {
            Storage::disk('public')->delete($kost->thumbnail);
        }

        $kost->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kos berhasil dihapus.'
        ]);
    }
}