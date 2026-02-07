<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; 
use App\Models\Kost; 

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Ambil ID random dari user & kost yg sudah ada di database
            'user_id' => User::inRandomOrder()->first()->id ?? 1, 
            'kost_id' => Kost::inRandomOrder()->first()->id ?? 1,
            
            // Rating random 1 sampai 5
            'rating' => fake()->numberBetween(1, 5),
            
            // Komentar random
            'comment' => fake()->randomElement([
                'Tempatnya bersih dan nyaman banget!',
                'Ibu kosnya ramah, fasilitas oke.',
                'Air sering mati, tolong diperbaiki.',
                'Lokasi strategis dekat kampus, mantap.',
                'Lumayan untuk harga segini.',
                'Wifi kencang, cocok buat nugas.',
                'Parkiran agak sempit tapi aman.',
                'Sangat rekomendasi buat mahasiswa!'
            ]),
        ];
    }
}