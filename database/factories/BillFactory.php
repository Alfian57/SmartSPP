<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nominal' => $this->faker->randomElement([300000, 500000]),
            'month' => $this->faker->randomElement(['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december']),
            'school_year' => $this->faker->randomElement(['2018/2019', '2019/2020', '2020/2021', '2021/2022', '2022/2023']),
            'disccount' => $this->faker->randomElement([0, 300000]),
            'status' => $this->faker->randomElement(['paid-off', 'not-paid-off']),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Bill $bill) {
            Payment::factory(5)->create([
                'bill_id' => $bill->id,
            ]);
        });
    }
}
