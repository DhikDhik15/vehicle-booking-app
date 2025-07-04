<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryCheckVehicle extends Model
{
    protected $table = 'history_check_vehicles';
    protected $fillable = [
        'vehicle_id',
        'service_schedule',
        'last_service',
        'condition',
        'note'
    ];

    public function vehicle()
    {
        return $this->belongsTo(VehicleModel::class);
    }
}
