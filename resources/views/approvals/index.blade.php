@extends('layouts.app')

@section('content')
<h4>Persetujuan Pemesanan</h4>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Pemesan</th>
            <th>Kendaraan</th>
            <th>Tujuan</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($approvals as $approval)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $approval->booking->user->name }}</td>
            <td>{{ $approval->booking->vehicle->name }}</td>
            <td>{{ $approval->booking->destination }}</td>
            <td>{{ $approval->booking->start_time }} - {{ $approval->booking->end_time }}</td>
            <td>
                <span
                    class="badge bg-{{ $approval->status == 'approved' ? 'success' : ($approval->status == 'rejected' ? 'danger' : 'warning') }}">
                    {{ ucfirst($approval->status) }}
                </span>
            </td>
            <td>
                @if ($approval->status == 'pending')
                <form action="{{ route('approvals.approve', $approval->booking_id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-success btn-sm">Setujui</button>
                </form>
                <form action="{{ route('approvals.reject', $approval->booking_id) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="text" name="note" placeholder="Alasan" class="form-control d-inline w-50" required>
                    <button class="btn btn-danger btn-sm">Tolak</button>
                </form>
                @else
                <em>-</em>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Tidak ada permintaan persetujuan</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection