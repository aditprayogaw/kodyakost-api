<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use Illuminate\Support\Facades\Validator;

class FacilityController extends Controller
{
    // 1. LIHAT SEMUA FASILITAS
    public function index()
    {
        $facilities = Facility::all();
        return response()->json(['success' => true, 'data' => $facilities]);
    }

    // 2. TAMBAH FASILITAS BARU
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:facilities,name', // Gak boleh duplikat
            'icon' => 'nullable|string', // Nama icon (misal: fa-wifi)
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $facility = Facility::create([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Fasilitas baru berhasil ditambahkan',
            'data' => $facility
        ], 201);
    }

    // 3. EDIT FASILITAS 
    public function update(Request $request, $id)
    {
        $facility = Facility::find($id);
        if (!$facility) return response()->json(['message' => 'Fasilitas tidak ditemukan'], 404);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:facilities,name,'.$id,
            'icon' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $facility->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil diupdate',
            'data' => $facility
        ]);
    }

    // 4. HAPUS FASILITAS 
    public function destroy($id)
    {
        $facility = Facility::find($id);
        if (!$facility) return response()->json(['message' => 'Fasilitas tidak ditemukan'], 404);

        $facility->delete();

        return response()->json(['success' => true, 'message' => 'Fasilitas dihapus']);
    }
}
