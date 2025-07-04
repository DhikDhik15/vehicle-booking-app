<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $table = 'vehicles';

    public function vehicleCheck()
    {
        return $this->hasOne(HistoryCheckVehicle::class, 'vehicle_id', 'id');
    }
}
