<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah pemesanan per bulan untuk grafik
        $monthly = Booking::select(
            DB::raw('DATE_FORMAT(start_time, "%Y-%m") as month'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $labels = $monthly->pluck('month');
        $data = $monthly->pluck('total');

        return view('dashboard', compact('labels', 'data'));
    }
}
