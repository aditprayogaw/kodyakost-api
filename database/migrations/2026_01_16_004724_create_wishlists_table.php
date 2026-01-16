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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            // Siapa yang nge-like?
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Kos mana yang di-like?
            $table->foreignId('kost_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Mencegah user menyukai kos yang sama berkali-kali
            $table->unique(['user_id', 'kost_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
