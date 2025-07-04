<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'driver_id',
        'purpose',
        'destination',
        'start_time',
        'end_time'
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function driver()
    {
        return $this->belongsTo(DriverModel::class);
    }

    public function approvals()
    {
        return $this->hasMany(BookingApproval::class);
    }
}
