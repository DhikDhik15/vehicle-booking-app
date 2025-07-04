<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookingExport implements FromCollection
{
    protected $start, $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return Booking::with(['user', 'vehicle', 'driver'])
            ->when($this->start, fn($q) => $q->whereDate('start_time', '>=', $this->start))
            ->when($this->end, fn($q) => $q->whereDate('end_time', '<=', $this->end))
            ->get()
            ->map(function ($b) {
                return [
                    'ID' => $b->id,
                    'Pemesan' => $b->user->name,
                    'Kendaraan' => $b->vehicle->name,
                    'Plat' => $b->vehicle->license_plate,
                    'Driver' => $b->driver->name,
                    'Tujuan' => $b->destination,
                    'Keperluan' => $b->purpose,
                    'Waktu Mulai' => $b->start_time,
                    'Waktu Selesai' => $b->end_time,
                    'Status' => $b->status,
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Pemesan', 'Kendaraan', 'Plat', 'Driver', 'Tujuan', 'Keperluan', 'Waktu Mulai', 'Waktu Selesai', 'Status'];
    }
}
