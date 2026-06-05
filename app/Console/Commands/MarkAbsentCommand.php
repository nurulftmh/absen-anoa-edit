<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;

class MarkAbsentCommand extends Command
{
    protected $signature = 'attendance:mark-absent';

    protected $description = 'Menandai user sebagai alpa jika tidak absen';

    public function handle()
    {
        $date = now()->toDateString();

        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $attendance = Attendance::where('user_id', $user->id)
                ->where('date', $date)
                ->first();

            if (!$attendance) {
                Attendance::create([
                    'user_id' => $user->id,
                    'date' => $date,
                    'status' => 'alpa',
                    'check_in' => null,
                    'check_out' => null,
                ]);
            }
        }

        $this->info('Proses alpa selesai.');
    }
}