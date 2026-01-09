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
            $table->foreignId('user_id')->constrained('users'); 
            $table->foreignId('room_id')->constrained('rooms'); 
            
            // Step 1: Informasi Ajuan
            $table->date('start_date'); 
            $table->integer('duration_months'); 
            $table->string('identity_card_path');
            
            // Step 2 & 3: Status & Payment
            $table->integer('total_price'); 
            $table->enum('status', ['requested', 'approved', 'rejected', 'paid', 'cancelled'])->default('requested');
            $table->string('snap_token')->nullable();
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
