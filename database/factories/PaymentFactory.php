<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_method' => $this->faker->randomElement(['Kpay','WavePay']),
            'amount' => $this->faker->numberBetween(20000,30000),
            'payment_slip' => $this->faker->imageUrl,
            'transaction_no' => $this->faker->unique()->numberBetween(100000, 999999),
            'payment_date' => date('Y-m-d'),
            'status' => $this->faker->randomElement(['paid','failed']),
            'reason' => $this->faker->word(),
            'application_id' => rand(1,10),
        ];
    }
}
