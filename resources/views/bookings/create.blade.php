@extends('layouts.app')

@section('content')
<h4>Buat Pemesanan Kendaraan</h4>

<form action="{{ route('bookings.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Kendaraan</label>
        <select name="vehicle_id" class="form-select" required>
            <option value="">-- Pilih Kendaraan --</option>
            @foreach ($vehicles as $v)
            <option value="{{ $v->id }}">{{ $v->name }} - {{ $v->license_plate }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Driver</label>
        <select name="driver_id" class="form-select" required>
            <option value="">-- Pilih Driver --</option>
            @foreach ($drivers as $d)
            <option value="{{ $d->id }}">{{ $d->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Keperluan</label>
        <input type="text" name="purpose" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tujuan</label>
        <input type="text" name="destination" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Waktu Mulai</label>
        <input type="datetime-local" name="start_time" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Waktu Selesai</label>
        <input type="datetime-local" name="end_time" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Approver Level 1</label>
        <select name="approvers[]" class="form-select" required>
            <option value="">-- Pilih Approver --</option>
            @foreach ($approvers->where('role', 'approver_level_1') as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Approver Level 2</label>
        <select name="approvers[]" class="form-select" required>
            <option value="">-- Pilih Approver --</option>
            @foreach ($approvers->where('role', 'approver_level_2') as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection