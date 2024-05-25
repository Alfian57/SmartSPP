<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = ['IX', 'X', 'XI'];
        $sections = ['A', 'B', 'C', 'D', 'E', 'F'];

        $sppPrice = [200000, 300000, 400000];

        foreach ($grades as $grade) {
            foreach ($sections as $section) {
                Classroom::create([
                    'name' => "$grade-$section",
                    'spp_price' => $sppPrice[array_rand($sppPrice)],
                ]);
            }
        }
    }
}
