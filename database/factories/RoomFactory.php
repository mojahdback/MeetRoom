<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
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
            'name' => fake()->word(),
            'capacity' => fake()->numberBetween(5, 50),
            'floor' => fake()->numberBetween(1, 4),
            'is_active' => true,

            'building_id' => Building::factory(),
        ];
    }
}
