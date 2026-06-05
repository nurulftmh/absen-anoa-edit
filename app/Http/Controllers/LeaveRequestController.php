<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveStatusMail;
use Illuminate\Support\Facades\Log;






class LeaveRequestController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date|after_or_equal:today',
        'reason' => 'required|string',
        'proof_file' => 'nullable|file|max:5120',
    ], [
        'date.after_or_equal' => 'Tanggal izin tidak boleh tanggal yang sudah berlalu.',
    ]);

    $attendance = Attendance::where('user_id', auth()->id())
        ->where('date', $request->date)
        ->first();

    if ($attendance && $attendance->check_in) {
        return back()->with('error', 'Kamu sudah absen di tanggal ini, tidak bisa mengajukan izin.');
    }

    $proofPath = null;

    if ($request->hasFile('proof_file')) {
        $proofPath = $request->file('proof_file')->store('leave-proofs', 'public');
    }

    LeaveRequest::create([
        'user_id' => auth()->id(),
        'date' => $request->date,
        'reason' => $request->reason,
        'proof_file' => $proofPath,
        'status' => 'pending',
    ]);

    return back()->with('success', 'Pengajuan izin berhasil dikirim ke pimpinan.');
}

    public function adminIndex(Request $request)
{
    $search = $request->search;

    $requests = LeaveRequest::with('user')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('reason', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('date', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
        })
        ->latest()
        ->paginate(15)
        ->withQueryString();

    return view('admin.leave-requests', compact('requests', 'search'));
}

    public function approve($id)
{
    $leave = LeaveRequest::with('user')->findOrFail($id);

    $leave->update([
        'status' => 'approved',
    ]);

    Attendance::updateOrCreate(
        [
            'user_id' => $leave->user_id,
            'date' => $leave->date,
        ],
        [
            'status' => 'izin',
            'check_in' => null,
            'check_out' => null,
        ]
    );

    try {
        if ($leave->user && $leave->user->email) {
            Mail::to($leave->user->email)->send(new LeaveStatusMail($leave));
        }

        return back()->with('success', 'Izin disetujui dan notifikasi email berhasil dikirim.');

    } catch (\Exception $e) {
        Log::error('Gagal mengirim email izin: ' . $e->getMessage());

        return back()->with('success', 'Izin disetujui, tetapi email gagal dikirim. Cek konfigurasi SMTP.');
    }
}

    public function reject($id)
{
    $leave = LeaveRequest::with('user')->findOrFail($id);

    $leave->update([
        'status' => 'rejected',
    ]);

    Attendance::where('user_id', $leave->user_id)
        ->where('date', $leave->date)
        ->update([
            'status' => 'alpa',
            'check_in' => null,
            'check_out' => null,
        ]);

    try {
        if ($leave->user && $leave->user->email) {
            Mail::to($leave->user->email)->send(new LeaveStatusMail($leave));
        }

        return back()->with('success', 'Izin ditolak dan notifikasi email berhasil dikirim.');

    } catch (\Exception $e) {
        Log::error('Gagal mengirim email izin: ' . $e->getMessage());

        return back()->with('success', 'Izin ditolak, tetapi email gagal dikirim. Cek konfigurasi SMTP.');
    }
}
}