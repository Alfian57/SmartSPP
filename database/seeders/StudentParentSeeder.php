<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Database\Seeder;

class StudentParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentParent = StudentParent::factory()->count(1)->createOne([
            'name' => 'Alfian Gading Saputra',
        ]);

        $studentParent->account()->create([
            'email' => 'alfian.parent@gmail.com',
            'password' => 'password',
        ]);

        Student::factory()->count(2)->create([
            'student_parent_id' => $studentParent->id,
        ]);
    }
}
