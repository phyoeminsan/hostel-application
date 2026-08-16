<?php

namespace Database\Factories;

use App\Models\Year;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Year>
 */
class YearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year_name' => $this->faker->randomElement([
                'First Year',
                'Second Year',
                'Third Year',
                'Fourth Year',
                'Final Year'
            ]),
        ];
    }
}
