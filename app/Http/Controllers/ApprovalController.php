<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\BookingApproval;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $approvals = BookingApproval::with('booking.vehicle', 'booking.user')
            ->where('approver_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('approvals.index', compact('approvals'));
    }

    public function approve(Booking $booking)
    {
        $this->processApproval($booking, 'approved');
        return back()->with('success', 'Pemesanan disetujui.');
    }

    public function reject(Booking $booking, Request $request)
    {
        $this->processApproval($booking, 'rejected', $request->note);
        return back()->with('success', 'Pemesanan ditolak.');
    }

    private function processApproval(Booking $booking, $action, $note = null)
    {
        $approval = $booking->approvals()
            ->where('approver_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if (!$approval) return;

        $approval->update([
            'status' => $action,
            'approved_at' => now(),
            'note' => $note,
        ]);

        Log::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'action' => $action,
        ]);

        // Check if all approvals are completed
        $statuses = $booking->approvals()->pluck('status');

        if ($statuses->contains('rejected')) {
            $booking->update(['status' => 'rejected']);
        } elseif ($statuses->every(fn($s) => $s === 'approved')) {
            $booking->update(['status' => 'approved']);
        }
    }
}
