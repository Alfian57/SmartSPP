<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
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
            'nominal' => $this->faker->randomElement([50000, 100000, 200000]),
            'bukti_transfer' => 'dummy.jpg',
            'status' => $this->faker->randomElement(['tervalidasi', 'belum-tervalidasi', 'menunggu-validasi']),
        ];
    }
}
