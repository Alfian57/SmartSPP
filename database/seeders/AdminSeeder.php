<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::factory()->count(1)->createOne([
            'name' => 'Alfian Gading Saputra',
        ]);

        $admin->account()->create([
            'email' => 'alfian.admin@gmail.com',
            'password' => 'password'
        ]);
    }
}