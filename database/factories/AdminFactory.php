<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Admin $admin) {
            $account = Account::factory()->makeOne();
            $admin->account()->save($account);
        });
    }
}
