<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = Student::factory()->count(1)->createOne([
            'name' => 'Alfian Gading Saputra',
        ]);

        $student->account()->create([
            'email' => 'alfian.student@gmail.com',
            'password' => 'password',
        ]);
    }
}
