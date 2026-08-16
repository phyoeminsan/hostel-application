<?php

namespace Database\Factories;

use App\Models\academic_year;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<academic_year>
 */
class Academic_yearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'academic_year' => $this->faker->randomElement([
                '2021-2022',
                '2022-2023',
                '2023-2024',
                '2024-2025',
                '2025-2026',
            ]),
            'status' => $this->faker->randomElement(['New','Old']),
        ];
    }
}
