<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\WorkProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkProgressController extends Controller
{
    public function index()
    {
        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', now())
            ->first();

        $workProgresses = WorkProgress::with('files')
            ->whereHas('attendance', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('work-progress', compact(
            'attendance',
            'workProgresses'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',

            // Maksimal 100 MB per file
            'files.*' => 'nullable|file|max:204800',
        ], [
            'description.required' => 'Deskripsi progres kerja wajib diisi.',
            'files.*.file' => 'Lampiran harus berupa file yang valid.',
            'files.*.max' => 'Ukuran setiap file maksimal 100 MB.',
        ]);

        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', now())
            ->first();

        if (! $attendance) {
            return back()->with('error', 'Kamu belum absen hari ini.');
        }

        if (! $attendance->check_in) {
            return back()->with('error', 'Kamu belum absen masuk hari ini.');
        }

        $progress = WorkProgress::create([
            'attendance_id' => $attendance->id,
            'description' => $request->description,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('progress_files', 'public');

                $progress->files()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        return back()->with('success', 'Progres kerja berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',

            // Maksimal 100 MB per file
            'files.*' => 'nullable|file|max:204800',
        ], [
            'description.required' => 'Deskripsi progres kerja wajib diisi.',
            'files.*.file' => 'Lampiran harus berupa file yang valid.',
            'files.*.max' => 'Ukuran setiap file maksimal 100 MB.',
        ]);

        $progress = WorkProgress::with('files')->findOrFail($id);

        if ($progress->attendance->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $progress->update([
            'description' => $request->description,
        ]);

        if ($request->hasFile('files')) {
            foreach ($progress->files as $oldFile) {
                Storage::disk('public')->delete($oldFile->file_path);
                $oldFile->delete();
            }

            foreach ($request->file('files') as $file) {
                $path = $file->store('progress_files', 'public');

                $progress->files()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        return back()->with('success', 'Progres kerja berhasil diperbarui.');
    }
}