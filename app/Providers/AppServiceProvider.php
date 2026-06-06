<?php

namespace App\Providers;

use App\Models\LeaveRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {

                /*
                |--------------------------------------------------------------------------
                | Notifikasi untuk Karyawan
                |--------------------------------------------------------------------------
                | Muncul jika izin karyawan sudah disetujui atau ditolak admin.
                */
                $leaveNotifications = LeaveRequest::where('user_id', auth()->id())
                    ->whereIn('status', ['approved', 'rejected'])
                    ->where('is_read', false)
                    ->latest()
                    ->take(5)
                    ->get();

                $leaveNotificationCount = LeaveRequest::where('user_id', auth()->id())
                    ->whereIn('status', ['approved', 'rejected'])
                    ->where('is_read', false)
                    ->count();

                /*
                |--------------------------------------------------------------------------
                | Notifikasi untuk Admin
                |--------------------------------------------------------------------------
                | Muncul jika ada karyawan yang mengajukan izin dan statusnya masih pending.
                */
                $adminLeaveRequests = collect();
                $adminLeaveRequestCount = 0;

                if (auth()->user()->role === 'admin') {
                    $adminLeaveRequests = LeaveRequest::with('user')
                        ->where('status', 'pending')
                        ->latest()
                        ->take(5)
                        ->get();

                    $adminLeaveRequestCount = LeaveRequest::where('status', 'pending')
                        ->count();
                }

                $view->with([
                    'leaveNotifications' => $leaveNotifications,
                    'leaveNotificationCount' => $leaveNotificationCount,
                    'adminLeaveRequests' => $adminLeaveRequests,
                    'adminLeaveRequestCount' => $adminLeaveRequestCount,
                ]);
            } else {
                $view->with([
                    'leaveNotifications' => collect(),
                    'leaveNotificationCount' => 0,
                    'adminLeaveRequests' => collect(),
                    'adminLeaveRequestCount' => 0,
                ]);
            }
        });
    }
}