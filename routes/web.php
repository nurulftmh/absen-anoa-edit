<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ManuscriptController;
use App\Http\Controllers\WorkProgressController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublishedBookController;
use App\Models\Attendance;
use App\Models\WorkProgress;
use Illuminate\Support\Facades\Route;
use App\Models\LeaveRequest;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return view('admin.dashboard');
    }

    $today = now()->toDateString();

    $attendance = Attendance::where('user_id', auth()->id())
        ->where('date', $today)
        ->first();

    $attendances = Attendance::where('user_id', auth()->id())
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();

    $workProgresses = WorkProgress::with('files')
        ->whereHas('attendance', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->latest()
        ->get();

    $rejectedLeave = \App\Models\LeaveRequest::where('user_id', auth()->id())
    ->where('status', 'rejected')
    ->where('is_read', false)
    ->latest()
    ->first();

    return view('dashboard', compact(
    'attendance',
    'attendances',
    'workProgresses',
    'rejectedLeave'
));
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| User & Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::post('/absen-masuk', [AttendanceController::class, 'checkIn'])
        ->name('attendance.checkin');

    Route::post('/absen-pulang', [AttendanceController::class, 'checkOut'])
        ->name('attendance.checkout');

    Route::get('/progres-kerja', [AttendanceController::class, 'progressPage'])
        ->name('work.progress.page');

    Route::post('/progres-kerja', [AttendanceController::class, 'storeProgress'])
        ->name('work.progress.store');

    Route::get('/work-progress', [WorkProgressController::class, 'index'])
        ->name('work.progress.index');

    Route::post('/work-progress', [WorkProgressController::class, 'store'])
        ->name('work.progress.store.alt');

    Route::patch('/work-progress/{id}', [WorkProgressController::class, 'update'])
        ->name('work.progress.update');

    Route::get('/books', [BookController::class, 'index'])
        ->name('books.index');

    Route::post('/books', [BookController::class, 'store'])
        ->name('books.store');

    Route::patch('/books/{id}', [BookController::class, 'update'])
        ->name('books.update');

    Route::delete('/books/{id}', [BookController::class, 'destroy'])
        ->name('books.destroy');

    Route::get('/published-books', [PublishedBookController::class, 'index'])
        ->name('published-books.index');

    Route::post('/published-books', [PublishedBookController::class, 'store'])
        ->name('published-books.store');

    Route::patch('/published-books/{publishedBook}', [PublishedBookController::class, 'update'])
        ->name('published-books.update');

    Route::delete('/published-books/{publishedBook}', [PublishedBookController::class, 'destroy'])
        ->name('published-books.destroy');
    Route::get('/manuscripts', [ManuscriptController::class, 'index'])
        ->name('manuscripts.index');

    Route::post('/manuscripts', [ManuscriptController::class, 'store'])
        ->name('manuscripts.store');

    Route::patch('/manuscripts/{id}', [ManuscriptController::class, 'update'])
        ->name('manuscripts.update');

    Route::delete('/manuscripts/{id}', [ManuscriptController::class, 'destroy'])
        ->name('manuscripts.destroy');

    Route::post('/izin', [LeaveRequestController::class, 'store'])
        ->name('leave.store');

    Route::get('/admin/izin', [LeaveRequestController::class, 'adminIndex'])
        ->name('admin.leave.index');

    Route::post('/admin/izin/{id}/approve', [LeaveRequestController::class, 'approve'])
        ->name('admin.leave.approve');

    Route::post('/admin/izin/{id}/reject', [LeaveRequestController::class, 'reject'])
        ->name('admin.leave.reject');

    Route::get('/admin/absensi', [AttendanceController::class, 'adminAttendance'])
        ->name('admin.attendance.index');

    Route::get('/admin/progres', [AttendanceController::class, 'adminProgress'])
        ->name('admin.progress.index');

    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');

    Route::patch('/admin/users/{user}/role', [AdminUserController::class, 'updateRole'])
        ->name('admin.users.updateRole');

    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])
        ->name('admin.users.destroy');

    Route::get('/admin/manuscripts', [ManuscriptController::class, 'adminIndex'])
        ->name('admin.manuscripts.index');

    Route::get('/admin/books', [BookController::class, 'adminIndex'])
        ->name('admin.books.index');
    
    Route::get('/admin/published-books', [PublishedBookController::class, 'adminIndex'])
        ->name('admin.published-books.index');
       Route::get('/admin/riwayat-absen/{user}', [AttendanceController::class, 'employeeHistory'])
    ->name('admin.attendance.history');
});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';