@extends('layouts.app')

@section('content')
<h4>Laporan Pemesanan Kendaraan</h4>

<form method="GET" class="row g-2 mb-3">
    <div class="col-md-3">
        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
    </div>
    <div class="col-md-3">
        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary">Filter</button>
    </div>
    <div class="col-md-2">
        <a href="{{ route('reports.export', request()->only(['start_date', 'end_date'])) }}"
            class="btn btn-success">Export Excel</a>
    </div>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Pemesan</th>
            <th>Kendaraan</th>
            <th>Driver</th>
            <th>Tujuan</th>
            <th>Waktu</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookings as $key => $b)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $b->user->name }}</td>
            <td>{{ $b->vehicle->name }}</td>
            <td>{{ $b->driver->name }}</td>
            <td>{{ $b->destination }}</td>
            <td>{{ $b->start_time }} - {{ $b->end_time }}</td>
            <td>
                <span
                    class="badge bg-{{ $b->status == 'approved' ? 'success' : ($b->status == 'rejected' ? 'danger' : 'warning') }}">
                    {{ ucfirst($b->status) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Data tidak ditemukan.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
