<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // 1. UPDATE PROFIL UMUM (Nama, HP, Avatar, Password)
    function update(Request $request)
    {
        $user = $request->user();

        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_whatsapp' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Proses Update
        $user->name = $request->name;
        $user->phone_whatsapp = $request->phone_whatsapp;

        // Update Avatar
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Update Password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'data' => $user
        ]);
    }

    // 2. UPLOAD KTP (KHUSUS TENANT)
    public function uploadKtp(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'ktp_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Hapus KTP lama jika ada (biar gak nyampah di server)
        if ($user->ktp_image && Storage::disk('public')->exists($user->ktp_image)) {
            Storage::disk('public')->delete($user->ktp_image);
        }

        // Upload KTP Baru
        $path = $request->file('ktp_image')->store('ktp_images', 'public');

        // Update Database
        $user->ktp_image = $path;
        $user->is_ktp_verified = false; 
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'KTP berhasil diupload. Akan divalidasi oleh pemilik kos saat booking.',
            'data' => $user 
        ]);
    }
}
