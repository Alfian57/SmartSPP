<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\StudentParent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentParent>
 */
class StudentParentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'phone_number' => $this->faker->phoneNumber,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (StudentParent $studentParent) {
            $account = Account::factory()->makeOne();
            $studentParent->account()->save($account);
        });
    }
}
