<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    function update(Request $request)
    {
        $user = $request->user();

        // 1. Validasi Input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone_whatsapp' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
            'password' => 'nullable|string|min:8|confirmed', // Confirmed: butuh field password_confirmation]);
        ]);

        // 2. Proses Update
        $user->name = $request->name;
        $user->phone_whatsapp = $request->phone_whatsapp;

        // 3. Cek apakah user ingin ganti avatar
        if (isset($data['avatar'])) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Simpan avatar baru ke folder 'avatars' di storage public
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path; // Simpan path-nya saja (contoh: avatars/namafile.jpg)
        }

        // 4. Cek apakah user ingin ganti password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 5. Simpan perubahan
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'data' => $user
        ]);
    }
}
