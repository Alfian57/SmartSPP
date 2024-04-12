<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Bill;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nisn' => $this->faker->unique()->numerify('##########'),
            'name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'date_of_birth' => $this->faker->date(),
            'religion' => $this->faker->randomElement(['islam', 'christianity', 'catholicism', 'hinduism', 'buddhism', 'confucianism']),
            'orphan_status' => $this->faker->randomElement(['orphan_both', 'orphan_father', 'orphan_mother', 'none']),
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'classroom_id' => function () {
                return \App\Models\Classroom::inRandomOrder()->first()->id;
            },
            'student_parent_id' => function () {
                return \App\Models\StudentParent::inRandomOrder()->first()->id;
            },
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Student $student) {
            $account = Account::factory()->makeOne();
            $student->account()->save($account);

            Bill::factory(3)->create([
                'student_id' => $student->id,
            ]);
        });
    }
}