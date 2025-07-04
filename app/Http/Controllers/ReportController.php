<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with('vehicle', 'driver', 'user')
            ->when($request->start_date, fn($q) => $q->whereDate('start_time', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->whereDate('end_time', '<=', $request->end_date))
            ->latest()
            ->get();

        return view('reports.index', compact('bookings'));
    }

    public function export(Request $request)
    {
        return Excel::download(new BookingExport($request->start_date, $request->end_date), 'laporan_pemesanan.xlsx');
    }
}
