<?php

namespace Database\Seeders;

use App\Enums\Gender;
use App\Enums\OrphanStatus;
use App\Enums\Religion;
use App\Models\Bill;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = Student::create([
            'name' => 'Alfian Gading Saputra',
            'nisn' => '1234567890',
            'gender' => Gender::MALE->value,
            'date_of_birth' => '1990-01-01',
            'religion' => Religion::ISLAM->value,
            'orphan_status' => OrphanStatus::NONE->value,
            'phone_number' => '0895363116378',
            'address' => '123 Main St',
            'classroom_id' => Classroom::inRandomOrder()->first()->id,
            'student_parent_id' => StudentParent::inRandomOrder()->first()->id,
        ]);

        $student->account()->create([
            'email' => 'alfian.student@gmail.com',
            'password' => 'password',
        ]);

        // Seed the bills
        // $familyDiscount = $student->studentParent->students->count() >= 2 ? config('spp.family_discount') : 0;
        // $orphanDiscount = $student->studentParent->status !== OrphanStatus::NONE->value ? config('spp.orphan_discount') : 0;

        // Bill::factory(3)->create([
        //     'student_id' => $student->id,
        //     'discount' => $familyDiscount + $orphanDiscount,
        // ]);
    }
}
