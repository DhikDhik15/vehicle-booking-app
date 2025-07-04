<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\DriverModel;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use App\Models\BookingApproval;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('vehicle', 'driver', 'user')->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $vehicles = VehicleModel::all();
        $drivers = DriverModel::all();
        $approvers = User::whereIn('role', ['approver_level_1', 'approver_level_2'])->get();
        return view('bookings.create', compact('vehicles', 'drivers', 'approvers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'purpose' => 'required|string',
            'destination' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'approvers' => 'required|array|size:2',
        ]);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'purpose' => $request->purpose,
            'destination' => $request->destination,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pending',
        ]);

        foreach ($request->approvers as $index => $approverId) {
            BookingApproval::create([
                'booking_id' => $booking->id,
                'approver_id' => $approverId,
                'level' => $index + 1,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('bookings.index')->with('success', 'Pemesanan berhasil dibuat.');
    }

    public function show(Booking $booking)
    {
        $booking->load('vehicle', 'vehicle.vehicleCheck', 'driver', 'user', 'approvals');
        return view('bookings.show', compact('booking'));
    }
}
