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

        $workProgresses = WorkProgress::whereHas('attendance', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('work-progress.index', compact(
            'attendance',
            'workProgresses'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'files.*' => 'nullable|file|max:5120',
        ]);

        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', now())
            ->first();

        if (!$attendance) {
            return back()->with('error', 'Kamu belum absen hari ini.');
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
            'description' => 'required',
            'files.*' => 'nullable|file|max:5120',
        ]);

        $progress = WorkProgress::findOrFail($id);

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