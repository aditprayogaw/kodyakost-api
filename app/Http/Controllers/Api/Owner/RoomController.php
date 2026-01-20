<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Kost;

class RoomController extends Controller
{
    // 1. LIHAT DAFTAR KAMAR DI KOS TERTENTU
    public function index(Request $request)
    {
        $request->validate(['kost_id' => 'required|exists:kosts,id']);

        // Cek apakah Kos ini milik User yang login?
        $kost = Kost::where('id', $request->kost_id)
                    ->where('user_id', $request->user()->id)
                    ->first();

        if (!$kost) {
            return response()->json(['message' => 'Kos tidak ditemukan atau bukan milik Anda.'], 403);
        }

        $rooms = Room::where('kost_id', $kost->id)->get();

        return response()->json(['success' => true, 'data' => $rooms]);
    }

    // 2. TAMBAH KAMAR BARU
    public function store(Request $request)
    {
        $request->validate([
            'kost_id' => 'required|exists:kosts,id', // Wajib tahu ini kamar buat kos yang mana
            'room_type' => 'required|string',
            'price_per_month' => 'required|integer',
            'total_rooms' => 'required|integer|min:1',
            'room_size' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        // Validasi Kepemilikan: Pastikan Owner ini pemilik Kos tersebut
        $isMyKost = Kost::where('id', $request->kost_id)
                        ->where('user_id', $request->user()->id)
                        ->exists();

        if (!$isMyKost) {
            return response()->json(['message' => 'Anda tidak berhak menambah kamar di kos ini.'], 403);
        }

        // Simpan Data
        $room = new Room($request->all());
        
        // Logika: Saat awal dibuat, available = total
        $room->available_rooms = $request->total_rooms;

        // Upload Gambar Kamar (Jika ada)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('room_images', 'public');
            $room->image = $path;
        }

        $room->save();

        return response()->json([
            'success' => true, 
            'message' => 'Tipe kamar berhasil ditambahkan.',
            'data' => $room
        ]);
    }

    // 3. EDIT KAMAR
    public function update(Request $request, $id)
    {
        // Cari room, sekalian cek apakah kosnya milik user ini
        $room = Room::where('id', $id)->whereHas('kost', function($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        })->first();

        if (!$room) {
            return response()->json(['message' => 'Kamar tidak ditemukan.'], 404);
        }

        $request->validate([
            'room_type' => 'sometimes|string',
            'price_per_month' => 'sometimes|integer',
            'total_rooms' => 'sometimes|integer',
            // dsb...
        ]);

        // Update data
        $room->update($request->except(['image'])); 

        return response()->json(['success' => true, 'message' => 'Kamar berhasil diupdate', 'data' => $room]);
    }

    // 4. HAPUS KAMAR
    public function destroy(Request $request, $id)
    {
        $room = Room::where('id', $id)->whereHas('kost', function($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        })->firstOrFail();

        $room->delete();

        return response()->json(['success' => true, 'message' => 'Kamar dihapus.']);
    }
}
