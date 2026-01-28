<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CulturalEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CulturalEventController extends Controller
{
    // 1. LIHAT SEMUA EVENT (Admin)
    public function index()
    {
        $events = CulturalEvent::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $events]);
    }

    // 2. TAMBAH EVENT BARU (Upload Image)
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'event_date'  => 'required|date',
            'location'    => 'required|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Proses Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan ke folder 'public/events'
            $imagePath = $request->file('image')->store('events', 'public');
        }

        // Simpan ke Database
        $event = CulturalEvent::create([
            'name'        => $request->name,
            'description' => $request->description,
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            'image'       => $imagePath, // Simpan path gambarnya
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event berhasil ditambahkan!',
            'data'    => $event
        ], 201);
    }

    // 3. EDIT EVENT (Update Image opsional)
    public function update(Request $request, $id)
    {
        $event = CulturalEvent::find($id);
        if (!$event) return response()->json(['message' => 'Event not found'], 404);

        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'event_date'  => 'required|date',
            'location'    => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Cek apakah user upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            // Upload gambar baru
            $event->image = $request->file('image')->store('events', 'public');
        }

        // Update data text
        $event->update([
            'name'        => $request->name,
            'description' => $request->description,
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            // Image otomatis terupdate jika ada logic di atas
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event berhasil diupdate!',
            'data'    => $event
        ]);
    }

    // 4. HAPUS EVENT
    public function destroy($id)
    {
        $event = CulturalEvent::find($id);
        if (!$event) return response()->json(['message' => 'Event not found'], 404);

        // Hapus file gambar dari penyimpanan biar gak nyampah
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return response()->json(['message' => 'Event berhasil dihapus']);
    }
}
