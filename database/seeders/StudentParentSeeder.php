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
        $studentParent = StudentParent::create([
            'nama' => 'Alfian Gading Saputra',
            'no_telepon' => '0895363116378',
        ]);

        $studentParent->account()->create([
            'email' => 'alfian.parent@gmail.com',
            'password' => 'password',
        ]);

        Student::factory()->count(2)->create([
            'id_orang_tua' => $studentParent->id,
        ]);
    }
}
