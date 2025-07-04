<?php

namespace Database\Seeders;

use App\Models\VehicleModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleModel::insert([
            ['name' => 'Vehicle 1', 'license_plate' => 'H 1234 IG', 'type' => 'angkutan_orang', 'owned_by' => 'internal'],
            ['name' => 'Vehicle 2', 'license_plate' => 'H 4321 AG', 'type' => 'angkutan_orang', 'owned_by' => 'rental'],
            ['name' => 'Vehicle 3', 'license_plate' => 'H 6789 YG', 'type' => 'angkutan_barang', 'owned_by' => 'internal'],
        ]);
    }
}
