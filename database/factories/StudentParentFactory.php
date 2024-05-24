<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Student;
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
            'phone_number' => $this->faker->numerify('############'),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (StudentParent $studentParent) {
            $account = Account::factory()->makeOne();
            $studentParent->account()->save($account);

            Student::factory(rand(1, 3))->create([
                'student_parent_id' => $studentParent->id,
            ]);
        });
    }
}
