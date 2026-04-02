📖 KodyaKost API Documentation (v1.1 - Latest Update)
Base URL: http://localhost:8000/api

Global Headers:

Accept: application/json

Content-Type: application/json

Authorization: Bearer {token} (Kecuali untuk Register/Login/Public Endpoint)

1. 🔐 Authentication & Profiling
Login User
Endpoint: POST /login

Description: Autentikasi user dan mendapatkan Sanctum Token. Response sekarang mengembalikan role untuk keperluan redirect di Frontend.

Request Body:

JSON
{
  "email": "tenant@example.com",
  "password": "password123"
}
Success Response (200 OK):

JSON
{
  "status": "success",
  "message": "Login berhasil",
  "access_token": "1|LaravelSanctumToken...",
  "user": {
    "id": 1,
    "name": "Budi Santoso",
    "email": "tenant@example.com",
    "role": "tenant", 
    "is_ktp_verified": true
  }
}
2. 📅 Sistem Booking (UPDATED: Menggunakan Resource)
A. List Booking (Owner / Tenant)
Endpoint: GET /owner/bookings atau GET /tenant/bookings

Description: Mengambil daftar transaksi. [BREAKING CHANGE] ID database disembunyikan untuk UI, wajib gunakan booking_code. Tanggal dan Rupiah sudah diformat otomatis oleh Backend.

Success Response (200 OK):

JSON
{
  "success": true,
  "message": "Daftar booking berhasil diambil",
  "data": [
    {
      "id": 1,
      "booking_code": "BK-26B08-X9Z1", 
      "status": "pending",
      "dates": {
        "start_date": "2026-08-17",
        "start_formatted": "17 Agustus 2026",
        "duration_text": "3 Bulan"
      },
      "payment": {
        "total_price": 1500000,
        "total_price_formatted": "Rp 1.500.000",
        "status": "unpaid"
      },
      "tenant": {
        "name": "Budi Santoso",
        "phone_whatsapp": "08123456789",
        "avatar_url": "https://kodyakost.test/storage/avatars/user.jpg"
      },
      "unit": {
        "kost_name": "Kost Melati",
        "room_type": "VIP A"
      }
    }
  ]
}
B. Approve / Reject Booking (Owner)
Endpoint: PUT /owner/bookings/{id}

Description: Mengubah status dari pending ke approved atau rejected. Otomatis men-trigger Notifikasi ke Tenant.

Request Body:

JSON
{
  "status": "approved" 
}
3. 🔔 Smart Notification System (NEW)
A. Get Notifications
Endpoint: GET /notifications

Description: Mengambil 20 notifikasi terbaru user. Mengandung metadata type untuk styling warna di UI Frontend.

Success Response (200 OK):

JSON
{
  "success": true,
  "data": {
    "unread_count": 1,
    "notifications": [
      {
        "id": "98a1b2c3-d4e5...",
        "title": "Booking Diterima! 🥳",
        "message": "Hore! Booking kamu diterima Owner. Segera lakukan pembayaran.",
        "type": "success", 
        "booking_code": "BK-26B08-X9Z1",
        "is_read": false,
        "created_at": "5 menit yang lalu"
      }
    ]
  }
}
B. Mark All as Read
Endpoint: POST /notifications/mark-read

Description: Menandai semua notifikasi user yang belum dibaca menjadi read.

Success Response (200 OK):

JSON
{
  "success": true,
  "message": "Semua notifikasi telah ditandai sudah dibaca."
}
4. 📊 Dashboard & Monitoring (UPDATED)
A. Admin System Logs
Endpoint: GET /admin/dashboard/logs?page=1

Description: Mengambil log sistem aplikasi (Render health, Midtrans error, dll). [UPDATE] Sekarang menggunakan sistem Pagination (10 data per halaman).

Success Response (200 OK):

JSON
{
  "success": true,
  "data": [
    {
      "id": 105,
      "service": "MIDTRANS_WEBHOOK",
      "level": "SUCCESS",
      "message": "Payment verified for BK-26B08-X9Z1",
      "created_at": "2026-04-02 14:00:00"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 10,
    "total": 50
  }
}
