<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // 1. Ambil List Notifikasi
    public function index(Request $request)
    {
        // Ambil notifikasi user yg login
        $notifications = $request->user()->notifications()->take(20)->get(); // Ambil 20 terakhir

        // Hitung berapa yang belum dibaca (unread) buat badge merah
        $unreadCount = $request->user()->unreadNotifications->count();

        return response()->json([
            'success' => true,
            'data' => [
                'notifications' => $notifications,
                'unread_count' => $unreadCount
            ]
        ]);
    }

    // 2. Tandai Sudah Dibaca (Saat user klik lonceng)
    public function markAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi ditandai sudah dibaca'
        ]);
    }
}