<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingApproval extends Model
{
    protected $table = 'booking_approval';
    protected $fillable = [
        'booking_id',
        'approver_id',
        'level',
        'status',
        'note'
    ];
    
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

}
