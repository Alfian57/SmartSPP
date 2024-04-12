<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Bill;
use App\Models\Classroom;
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
        Classroom::factory(50)->create();
        Admin::factory(5)->create();
        StudentParent::factory(100)->create();
        Admin::factory(120)->create();

        Bill::factory(10)->create();
    }
}
