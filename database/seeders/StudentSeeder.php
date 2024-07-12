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
        // $student = Student::create([
        //     'nama' => 'Alfian Gading Saputra',
        //     'nisn' => '1234567890',
        //     'jenis_kelamin' => Gender::MALE->value,
        //     'tanggal_lahir' => '1990-01-01',
        //     'agama' => Religion::ISLAM->value,
        //     'status' => OrphanStatus::NONE->value,
        //     'no_telepon' => '0895363116378',
        //     'alamat' => '123 Main St',
        //     'id_kelas' => Classroom::inRandomOrder()->first()->id,
        //     'id_orang_tua' => StudentParent::inRandomOrder()->first()->id,
        // ]);

        // $student->account()->create([
        //     'email' => 'alfian.student@gmail.com',
        //     'password' => 'password',
        // ]);

        // Seed the bills
        // $familyDiscount = $student->studentParent->students->count() >= 2 ? config('spp.family_discount') : 0;
        // $orphanDiscount = $student->studentParent->status !== OrphanStatus::NONE->value ? config('spp.orphan_discount') : 0;

        // Bill::factory(3)->create([
        //     'id_siswa' => $student->id,
        //     'diskon' => $familyDiscount + $orphanDiscount,
        // ]);


        $student = Student::create([
            'nama' => 'Siswa Dummy',
            'nisn' => '1234567899',
            'jenis_kelamin' => Gender::MALE->value,
            'tanggal_lahir' => '1990-01-01',
            'agama' => Religion::ISLAM->value,
            'status' => OrphanStatus::NONE->value,
            'no_telepon' => '0895363116378',
            'alamat' => '123 Main St',
            'id_kelas' => Classroom::inRandomOrder()->first()->id,
            'id_orang_tua' => StudentParent::inRandomOrder()->first()->id,
        ]);

        $student->account()->create([
            'email' => 'student@student.com',
            'password' => 'password',
        ]);
    }
}
