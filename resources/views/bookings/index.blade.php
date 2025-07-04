@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Daftar Pemesanan Kendaraan</h4>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary">+ Tambah Pemesanan</a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Nama Pemesan</th>
            <th>Kendaraan</th>
            <th>Tujuan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $booking->user->name }}</td>
            <td>{{ $booking->vehicle->name }}</td>
            <td>{{ $booking->destination }}</td>
            <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
            <td>
                <span
                    class="badge bg-{{ $booking->status == 'approved' ? 'success' : ($booking->status == 'rejected' ? 'danger' : 'warning') }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </td>
            <td><a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-info">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection