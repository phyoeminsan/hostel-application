<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
     protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'roll_no' => 'UCSPL-' . $this->faker->unique()->numberBetween(100,2000),
            'name' => $this->faker->word,
            'major_id' => rand(1,3),
            'gender' => $this->faker->randomElement(['male','female']),
            'nrc' => $this->faker->word(),
            'date_of_birth' => $this->faker->dateTimeBetween('-25 years', '-18 years')->format('Y-m-d'),
            'phone_no' => '09' . $this->faker->numerify('#########'),
            'address' => $this->faker->word,
            'profile' => $this->faker->imageUrl,
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
