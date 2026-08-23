<?php

namespace Database\Factories;

use App\Models\Hostel_application;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Hostel_application>
 */
class Hostel_applicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'record_id' => rand(1,10),
            'hostel_id' => rand(1,3),
            'apply_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending','approved','rejected']),
            'reason' => $this->faker->word,
        ];
    }
}
