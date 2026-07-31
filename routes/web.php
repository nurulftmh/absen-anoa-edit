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
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Media Route
|--------------------------------------------------------------------------
| Route ini dipakai untuk menampilkan file/foto dari storage/app/public
| tanpa bergantung penuh pada asset('storage/...').
|--------------------------------------------------------------------------
*/
Route::get('/media/{path}', function ($path) {
    $path = str_replace('\\', '/', $path);
    $path = ltrim($path, '/');

    if (str_starts_with($path, 'public/')) {
        $path = substr($path, strlen('public/'));
    }

    if (str_starts_with($path, 'storage/')) {
        $path = substr($path, strlen('storage/'));
    }

    if (str_contains($path, '..')) {
        abort(403);
    }

    $fullPath = storage_path('app/public/' . $path);

    if (! File::exists($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath);
})->where('path', '.*')->name('media.show');

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

    return view('dashboard', compact(
        'attendance',
        'attendances',
        'workProgresses'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| User & Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Notification Routes
    |--------------------------------------------------------------------------
    */
    Route::post('/notifications/leave/read', [LeaveRequestController::class, 'markLeaveNotificationsAsRead'])
        ->name('notifications.leave.read');

    /*
    |--------------------------------------------------------------------------
    | Attendance
    |--------------------------------------------------------------------------
    */
    Route::post('/absen-masuk', [AttendanceController::class, 'checkIn'])
        ->name('attendance.checkin');

    Route::post('/absen-pulang', [AttendanceController::class, 'checkOut'])
        ->name('attendance.checkout');

    /*
    |--------------------------------------------------------------------------
    | Work Progress
    |--------------------------------------------------------------------------
    */
    Route::get('/progres-kerja', [WorkProgressController::class, 'index'])
        ->name('work.progress.index');

    Route::post('/progres-kerja', [WorkProgressController::class, 'store'])
        ->name('work.progress.store');

    Route::patch('/progres-kerja/{id}', [WorkProgressController::class, 'update'])
        ->name('work.progress.update');

    Route::get('/work-progress', function () {
        return redirect()->route('work.progress.index');
    })->name('work.progress.old');

    /*
    |--------------------------------------------------------------------------
    | Books
    |--------------------------------------------------------------------------
    */
    Route::get('/books', [BookController::class, 'index'])
        ->name('books.index');

    Route::post('/books', [BookController::class, 'store'])
        ->name('books.store');

    Route::patch('/books/{id}', [BookController::class, 'update'])
        ->name('books.update');

    Route::delete('/books/{id}', [BookController::class, 'destroy'])
        ->name('books.destroy');

    /*
    |--------------------------------------------------------------------------
    | Published Books
    |--------------------------------------------------------------------------
    */
    Route::get('/published-books', [PublishedBookController::class, 'index'])
        ->name('published-books.index');

    Route::post('/published-books', [PublishedBookController::class, 'store'])
        ->name('published-books.store');

    Route::patch('/published-books/{publishedBook}', [PublishedBookController::class, 'update'])
        ->name('published-books.update');

    Route::delete('/published-books/{publishedBook}', [PublishedBookController::class, 'destroy'])
        ->name('published-books.destroy');

    /*
    |--------------------------------------------------------------------------
    | Manuscripts
    |--------------------------------------------------------------------------
    */
    Route::get('/manuscripts', [ManuscriptController::class, 'index'])
        ->name('manuscripts.index');

    Route::post('/manuscripts', [ManuscriptController::class, 'store'])
        ->name('manuscripts.store');

    Route::patch('/manuscripts/{id}', [ManuscriptController::class, 'update'])
        ->name('manuscripts.update');

    Route::delete('/manuscripts/{id}', [ManuscriptController::class, 'destroy'])
        ->name('manuscripts.destroy');

    /*
    |--------------------------------------------------------------------------
    | Leave Request / Izin
    |--------------------------------------------------------------------------
    */
    Route::post('/izin', [LeaveRequestController::class, 'store'])
        ->name('leave.store');

    Route::get('/admin/izin', [LeaveRequestController::class, 'adminIndex'])
        ->name('admin.leave.index');

    Route::post('/admin/izin/{id}/approve', [LeaveRequestController::class, 'approve'])
        ->name('admin.leave.approve');

    Route::post('/admin/izin/{id}/reject', [LeaveRequestController::class, 'reject'])
        ->name('admin.leave.reject');

    /*
    |--------------------------------------------------------------------------
    | Admin Attendance
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/absensi', [AttendanceController::class, 'adminAttendance'])
        ->name('admin.attendance.index');

    Route::get('/admin/riwayat-absen/{user}', [AttendanceController::class, 'employeeHistory'])
        ->name('admin.attendance.history');

    /*
    |--------------------------------------------------------------------------
    | Admin Progress
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/progres', [AttendanceController::class, 'adminProgress'])
        ->name('admin.progress.index');

    /*
    |--------------------------------------------------------------------------
    | Admin Users
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');

    Route::patch('/admin/users/{user}/role', [AdminUserController::class, 'updateRole'])
        ->name('admin.users.updateRole');

    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])
        ->name('admin.users.destroy');

    /*
    |--------------------------------------------------------------------------
    | Admin Manuscripts
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/manuscripts', [ManuscriptController::class, 'adminIndex'])
        ->name('admin.manuscripts.index');

    /*
    |--------------------------------------------------------------------------
    | Admin Books
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/books', [BookController::class, 'adminIndex'])
        ->name('admin.books.index');

    Route::get('/admin/published-books', [PublishedBookController::class, 'adminIndex'])
        ->name('admin.published-books.index');
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

require __DIR__ . '/auth.php';