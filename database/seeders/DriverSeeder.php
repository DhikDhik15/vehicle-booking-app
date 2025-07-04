<?php

namespace Database\Seeders;

use App\Models\DriverModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DriverModel::insert([
            ['name' => 'Driver 1', 'phone' => '0815432103948'],
            ['name' => 'Driver 2', 'phone' => '0852930495039'],
            ['name' => 'Driver 3', 'phone' => '0853029384023'],
        ]);
    }
}
