<?php

namespace Database\Seeders;

use App\Enums\BillStatus;
use App\Enums\OrphanStatus;
use App\Enums\PaymentStatus;
use App\Models\Admin;
use App\Models\Student;
use App\Models\StudentParent;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClassroomSeeder::class,
            AdminSeeder::class,
            StudentParentSeeder::class,
            StudentSeeder::class,
        ]);

        Admin::factory(2)->create();
        StudentParent::factory(20)->create();

        $this->generateBill();
        $this->generatePayment();
    }

    private function generateBill()
    {
        Student::all()->each(function ($student) {
            $firstYear = now()->format('m') <= 6 ? now()->format('Y') - 1 : now()->format('Y');
            $secondYear = now()->format('m') <= 6 ? now()->format('Y') : now()->format('Y') + 1;

            $familyDiscount = $student->studentParent->students->count() >= 2 ? config('spp.family_discount') : 0;
            $orphanDiscount = $student->studentParent->status !== OrphanStatus::NONE->value ? config('spp.orphan_discount') : 0;

            $student->bills()->create([
                'nominal' => $student->classroom->harga_spp,
                'bulan' => now()->format('F'),
                'tahun_ajaran' => $firstYear.'/'.$secondYear,
                'diskon' => $familyDiscount + $orphanDiscount,
                'status' => BillStatus::NOT_PAID_OFF->value,
            ]);
        });
    }

    private function generatePayment()
    {
        Student::all()->each(function ($student) {
            $student->bills->each(function ($bill) {
                $bill->payments()->create([
                    'nominal' => ($bill->nominal - $bill->diskon) / 2,
                    'status' => PaymentStatus::VALIDATED->value,
                ]);
            });
        });
    }
}
