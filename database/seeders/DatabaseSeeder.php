<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kost;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 1 Admin
        User::factory()->create([
            'name' => 'Admin KodyaKost',
            'email' => 'admin@kodyakost.com',
            'role' => 'admin',
        ]);

        // 2. Buat 5 User dengan role 'owner'
        // Setiap owner otomatis akan dibuatkan 1 Kost, 
        // dan setiap Kost otomatis punya 3 tipe Room.
        User::factory()
            ->count(5)
            ->create(['role' => 'owner'])
            ->each(function ($user) {
                Kost::factory()
                    ->count(1)
                    ->hasRooms(5)
                    ->create(['user_id' => $user->id]);
            });

        // 3. Buat 10 User dengan role 'tenant' untuk simulasi penyewa
        User::factory()->count(10)->create(['role' => 'tenant']);
    }
}