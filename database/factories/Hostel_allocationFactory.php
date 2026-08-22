<?php

namespace Database\Factories;

use App\Models\Hostel_allocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Hostel_allocation>
 */
class Hostel_allocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_id' => rand(1,10),
            'room_id' => rand(1,20),
            'allocation_date' => date('Y-m-d'),
            'status' => $this->faker->randomElement(['active','unactive']),
            'description' => $this->faker->paragraph,
        ];
    }
}
