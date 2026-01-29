<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CulturalEvent;
use Illuminate\Support\Facades\Validator;

class CulturalEventController extends Controller
{
    // 1. LIHAT SEMUA EVENT
    public function index()
    {
        // Urutkan dari yang terbaru dibuat
        $events = CulturalEvent::orderBy('created_at', 'desc')->get();
        return response()->json(['success' => true, 'data' => $events]);
    }

    // 2. TAMBAH EVENT BARU (Sesuai Database Kamu)
    public function store(Request $request)
    {
        // Validasi Input (Raw JSON)
        $validator = Validator::make($request->all(), [
            'event_name'  => 'required|string|max:255',
            'event_type'  => 'required|string', // misal: pawai, upacara
            'description' => 'required|string',
            'event_date'  => 'required|date',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
            'severity'    => 'required|in:high,medium,low', // Validasi level macet
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Simpan ke Database
        $event = CulturalEvent::create([
            'event_name'  => $request->event_name,
            'event_type'  => $request->event_type,
            'description' => $request->description,
            'event_date'  => $request->event_date,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'severity'    => $request->severity,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event berhasil ditambahkan!',
            'data'    => $event
        ], 201);
    }

    // 3. EDIT EVENT
    public function update(Request $request, $id)
    {
        $event = CulturalEvent::find($id);
        if (!$event) return response()->json(['message' => 'Event not found'], 404);

        // Validasi (Nullable biar bisa edit sebagian aja)
        $validator = Validator::make($request->all(), [
            'event_name'  => 'nullable|string|max:255',
            'event_type'  => 'nullable|string',
            'description' => 'nullable|string',
            'event_date'  => 'nullable|date',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
            'severity'    => 'nullable|in:high,medium,low',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update Data
        $event->update($request->all());

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

        // Langsung hapus (karena gak ada file gambar yg perlu dihapus)
        $event->delete();

        return response()->json(['success' => true, 'message' => 'Event berhasil dihapus']);
    }
}