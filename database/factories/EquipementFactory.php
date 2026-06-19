<?php

namespace Database\Factories;

use App\Models\Equipement;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Equipement>
 */
class EquipementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
             'name' => fake()->randomElement([
                'Projector',
                'TV Screen',
                'Speaker',
                'Microphone',
                'Camera'
            ]),

            'type' => fake()->randomElement([
                'audio',
                'video',
                'display',
                'autre'
            ]),

            'description' => fake()->sentence(),
        ];
    }
}
