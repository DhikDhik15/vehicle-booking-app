<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['name' => 'Admin', 'email' => 'admin@mail.com', 'password' => bcrypt('password'), 'role' => 'admin'],
            ['name' => 'Approver 1', 'email' => 'approver1@mail.com', 'password' => bcrypt('password'), 'role' => 'approver_level_1'],
            ['name' => 'Approver 2', 'email' => 'approver2@mail.com', 'password' => bcrypt('password'), 'role' => 'approver_level_2'],
        ]);
    }
}
