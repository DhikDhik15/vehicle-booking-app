@extends('layouts.app')

@section('content')
<h4>Detail Pemesanan</h4>

<div class="card mb-3">
    <div class="card-body">
        <h5>Kendaraan: {{ $booking->vehicle->name }}</h5>
        <p>Driver: {{ $booking->driver->name }}</p>
        <p>Keperluan: {{ $booking->purpose }}</p>
        <p>Tujuan: {{ $booking->destination }}</p>
        <p>Waktu: {{ $booking->start_time }} s/d {{ $booking->end_time }}</p>
        <p>Kondisi Kendaraan: {{ $booking->vehicle->vehicleCheck->condition}}</p>
        <p>Catatan Kendaraan: {{ $booking->vehicle->vehicleCheck->note}}</p>
        <p>Status:
            <span
                class="badge bg-{{ $booking->status == 'approved' ? 'success' : ($booking->status == 'rejected' ? 'danger' : 'warning') }}">
                {{ ucfirst($booking->status) }}
            </span>
        </p>
    </div>
</div>

<h5>Riwayat Persetujuan</h5>
<ul class="list-group">
    @foreach ($booking->approvals as $a)
    <li class="list-group-item">
        Level {{ $a->level }} - {{ $a->approver->name }}:
        <strong>{{ ucfirst($a->status) }}</strong>
        @if ($a->approved_at)
        ({{ $a->approved_at }})
        @endif
    </li>
    @endforeach
</ul>
@endsection
