<?php

namespace Database\Factories;

use App\Models\Hostel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Hostel>
 */
class HostelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hostel_name' => $this->faker->word,
            'gender' => $this->faker->randomElement(['male','female']),
            'capacity'    => $this->faker->randomElement([1, 2]),
        ];
    }
}
