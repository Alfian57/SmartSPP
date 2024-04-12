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
            'school_year' => $this->faker->year(),
            'student_id' => function () {
                return \App\Models\Student::inRandomOrder()->first()->id;
            },
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Bill $bill) {
            $payments = Payment::factory(5)->create();
            $bill->payments()->save($payments);
        });
    }
}
