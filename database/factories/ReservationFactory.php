<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    $start = Carbon::instance(
        fake()->dateTimeBetween('+1 day', '+1 month')
    );

    return [
        'user_id' => User::pluck('id')->random(),
 
        'room_id' => Room::pluck('id')->random(),
 
        'start_datetime' => $start,
        'end_datetime' => $start->copy()->addHours(2),

        'status' => fake()->randomElement([
            'pending',
            'confirmed',
            'cancelled',
        ]),

        'notes' => fake()->sentence(),
    ];
   }
}
