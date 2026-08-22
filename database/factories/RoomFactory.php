<?php

namespace Database\Factories;

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
            'room_no' => 'R-' . $this->faker->unique()->numberBetween(100, 200),
            'floor_no' => $this->faker->randomElement(['1st', '2rd']),
            'no_of_person' => $this->faker->randomElement([1, 2]),
            'status' => $this->faker->randomElement(['Available', 'Full']),
            'hostel_id' => rand(1,3),
        ];
    }
}
