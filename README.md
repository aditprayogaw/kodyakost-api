<h1 align="center">KodyaKost - Backend API</h1>

<p align="center">
  Sistem Manajemen & Reservasi Kos Terintegrasi Khusus Wilayah Denpasar, Bali.
  <br>
  <strong>RESTful API dengan Laravel 12</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

<p align="center">
  <a href="https://kodyakost.adityavisual.my.id/"><h2>Lihat Website KodyaKost</a>
</p>

---

## 📖 Tentang Proyek

**KodyaKost** hadir untuk menyelesaikan masalah pencarian tempat tinggal (kos) di Denpasar yang sering kali melelahkan dan penuh dengan informasi tidak valid. Proyek backend ini menyediakan RESTful API yang melayani aplikasi frontend (Vue.js) untuk memfasilitasi tiga peran utama: **Admin, Owner (Pemilik Kos), dan Tenant (Pencari Kos)**.

Sistem ini dirancang dengan arsitektur yang bersih, validasi data yang ketat, dan integrasi _Payment Gateway_ otomatis.

---

## ✨ Fitur Utama

- **Multi-Role Authentication:** Sistem login dan otorisasi menggunakan Laravel Sanctum untuk Admin, Owner, dan Tenant.
- **Auto-Correct & Sanitizer:** Pembersihan format nomor WhatsApp secara otomatis dan validasi unggahan dokumen KTP.
- **Smart Booking System (4-Step Flow):**
  1. Pengajuan Sewa (Tenant)
  2. Persetujuan Berkas (Owner)
  3. Pembayaran Digital (Midtrans)
  4. Konfirmasi Check-in & Akses WiFi
- **Midtrans Payment Integration:** Integrasi Snap Token dan Webhook Handler untuk *auto-update* status lunas dan pengurangan stok kamar secara *real-time*.
- **Smart Notification System:** Notifikasi berbasis *database* yang mengirimkan status *booking* secara dinamis (warna/ikon) kepada user.
- **Cultural Event Mapping:** Mendata jadwal upacara adat dan titik kemacetan/penutupan jalan di area Denpasar (Fitur khas lokal Bali).
- **Owner Dashboard & Statistics:** Rekapitulasi pendapatan dan tingkat okupansi (ketersediaan kamar) secara *real-time*.

---

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Language:** PHP 8.2+
- **Database:** MySQL
- **Authentication:** Laravel Sanctum
- **Payment Gateway:** Midtrans (Core API / Snap)
- **API Formatter:** Laravel API Resources

---

## 🚀 Panduan Instalasi (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan backend KodyaKost di komputer lokal Anda:

### 1. Prerequisites
Pastikan Anda telah menginstal:
- PHP >= 8.2
- Composer
- MySQL / MariaDB

### 2. Clone Repository
bash
git clone https://github.com/aditprayogaw/kodyakost-api.git
cd kodyakost-api

3. Install Dependencies
Bash
composer install

4. Setup Environment
Salin file konfigurasi environment bawaan dan sesuaikan dengan kredensial database Anda.

Bash
cp .env.example .env
Buka file .env dan atur koneksi database:

Cuplikan kode
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kodyakost_db
DB_USERNAME=root
DB_PASSWORD=

# Konfigurasi Midtrans
MIDTRANS_SERVER_KEY=your-server-key-here
MIDTRANS_CLIENT_KEY=your-client-key-here
MIDTRANS_IS_PRODUCTION=false

5. Generate Application Key
Bash
php artisan key:generate
6. Migrasi & Seeding Database
Jalankan migrasi untuk membuat tabel dan jalankan seeder untuk mengisi data dummy (User, Fasilitas, dll).

Bash
php artisan migrate:fresh --seed

7. Link Storage (Untuk Foto Kos & KTP)
Bash
php artisan storage:link

9. Jalankan Server
Bash
php artisan serve
API sekarang dapat diakses melalui http://127.0.0.1:8000.

📡 API Documentation
Dokumentasi endpoint API secara lengkap (Request, Parameters, dan Responses) dapat diakses melalui Postman Collection.
Postman Collection: [Link ke file JSON Postman atau URL Workspace]

👥 Tim Pengembang (AK-47 / IT プログラミング2)
Nyoman Krisna Adi Guna - Backend Developer
Made Aditya Prayoga - Frontend Developer

🔒 Lisensi & Keamanan
Proyek ini dibuat untuk keperluan akademis/komersial. Jika Anda menemukan kerentanan keamanan di dalam KodyaKost, silakan hubungi tim pengembang langsung sebelum membukanya ke publik.
