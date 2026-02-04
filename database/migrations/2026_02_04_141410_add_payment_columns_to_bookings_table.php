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
        Schema::table('bookings', function (Blueprint $table) {
            // ID Unik dari Midtrans
            $table->string('midtrans_order_id')->nullable()->after('id');
            
            // Status Bayar (Beda sama Status Sewa)
            $table->enum('payment_status', ['unpaid', 'paid', 'expired', 'failed'])->default('unpaid')->after('status');
            
            // Link Bayar
            $table->string('payment_url')->nullable()->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['midtrans_order_id', 'payment_status', 'payment_url']);
        });
    }
};
