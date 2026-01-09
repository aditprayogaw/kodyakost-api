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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kost_id')->constrained('kosts')->onDelete('cascade'); 
            $table->string('room_type'); 
            $table->integer('price_per_month'); 
            $table->integer('total_rooms');
            $table->integer('available_rooms'); 
            $table->string('room_size')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
