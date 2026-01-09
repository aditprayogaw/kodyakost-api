<?php

namespace Database\Factories;

use App\Models\Kost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kost_id' => Kost::factory(),
            'room_type' => $this->faker->randomElement(['Standard', 'Deluxe', 'VIP']),
            'price_per_month' => $this->faker->numberBetween(800000, 3000000),
            'total_rooms' => 10,
            'available_rooms' => $this->faker->numberBetween(0, 10),
            'room_size' => '3x4',
        ];
    }
}
