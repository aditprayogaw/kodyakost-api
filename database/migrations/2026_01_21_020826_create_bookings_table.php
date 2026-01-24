<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // Siapa yang nyewa?
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Kamar mana yang disewa?
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            
            // Tanggal sewa
            $table->date('start_date');
            $table->date('end_date');
            
            // Status Booking (Penting untuk fitur Active Mode)
            // 'pending' = baru request
            // 'active'  = sedang ngekos (bayar lunas/masuk)
            // 'finished'= sudah keluar
            // 'canceled'= batal
            $table->enum('status', ['pending', 'approved', 'active', 'finished', 'canceled'])->default('pending');
            
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
