<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'nama' => 'Alfian Gading Saputra',
        ]);

        $admin->account()->create([
            'email' => 'alfian.admin@gmail.com',
            'password' => 'password',
        ]);
    }
}
