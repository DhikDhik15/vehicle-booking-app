<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistoryCheckVehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleChekSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HistoryCheckVehicle::insert([
            ['vehicle_id' => 1, 'service_schedule' => '2025-07-04 14:43:12', 'last_service' => '2025-02-04 09:23:01', 'condition' => 'layak', 'note' => '-'],
            ['vehicle_id' => 2, 'service_schedule' => '2025-08-05 10:43:12', 'last_service' => '2025-03-05 10:33:20', 'condition' => 'layak', 'note' => 'kondisi prima'],
            ['vehicle_id' => 3, 'service_schedule' => '2025-09-06 13:43:12', 'last_service' => '2025-04-06 11:43:30', 'condition' => 'kurang layak', 'note' => 'perlu perbaikan'],
        ]);
    }
}
