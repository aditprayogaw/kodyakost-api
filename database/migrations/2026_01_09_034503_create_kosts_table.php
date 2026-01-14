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
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->string('name');
            $table->string('thumbnail')->nullable();
            $table->text('description'); 
            $table->text('address'); 
            $table->enum('district', ['Denpasar Barat', 'Denpasar Timur', 'Denpasar Utara', 'Denpasar Selatan']); 
            $table->string('village');
            $table->decimal('latitude', 10, 8); 
            $table->decimal('longitude', 11, 8);
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosts');
    }
};
