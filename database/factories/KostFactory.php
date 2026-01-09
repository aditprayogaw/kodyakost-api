<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kost>
 */
class KostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'owner')->inRandomOrder()->first()->id ?? User::factory(),
            'name' => $this->faker->company() . ' Kost',
            'description' => $this->faker->paragraph(),
            'address' => $this->faker->address(),
            'district' => $this->faker->randomElement(['Denpasar Barat', 'Denpasar Timur', 'Denpasar Utara', 'Denpasar Selatan']),
            'village' => $this->faker->streetName(),
            'latitude' => $this->faker->latitude(-8.72, -8.62), // Range Denpasar
            'longitude' => $this->faker->longitude(115.18, 115.26),
            'is_verified' => $this->faker->boolean(70), // 70% peluang true
        ];
    }
}
