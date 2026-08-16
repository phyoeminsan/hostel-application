<?php

namespace Database\Factories;

use App\Models\Student_record;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student_record>
 */
class Student_recordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'academic_year_id' => rand(1,10),
            'year_id' => rand(1,10),
            'student_id' => rand(1,10),
        ];
    }
}
