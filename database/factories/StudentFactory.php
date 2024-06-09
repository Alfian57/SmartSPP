<?php

namespace Database\Factories;

use App\Enums\OrphanStatus;
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
            'nama' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'tanggal_lahir' => $this->faker->date(),
            'agama' => $this->faker->randomElement(['islam', 'kristen', 'katholik', 'hindu', 'budha', 'konghuchu']),
            'status' => $this->faker->randomElement(['yatim-piatu', 'yatim', 'piatu', 'none']),
            'no_telepon' => $this->faker->numerify('############'),
            'alamat' => $this->faker->address,
            'id_kelas' => function () {
                return \App\Models\Classroom::inRandomOrder()->first()->id;
            },
            'id_orang_tua' => function () {
                return \App\Models\StudentParent::inRandomOrder()->first()->id;
            },
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Student $student) {
            $account = Account::factory()->makeOne();
            $student->account()->save($account);

            // Seed the bills
            $familyDiscount = $student->studentParent->students->count() >= 2 ? config('spp.family_discount') : 0;
            $orphanDiscount = $student->studentParent->status !== OrphanStatus::NONE->value ? config('spp.orphan_discount') : 0;
            Bill::factory(3)->create([
                'id_siswa' => $student->id,
                'diskon' => $familyDiscount + $orphanDiscount,
            ]);
        });
    }
}
