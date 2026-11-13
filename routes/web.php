<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ManuscriptController;
use App\Http\Controllers\WorkProgressController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublishedBookController;
use App\Http\Controllers\PublicBookController;
use App\Http\Controllers\EbookCheckoutController;

use App\Models\Attendance;
use App\Models\WorkProgress;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| MEDIA ROUTE
|--------------------------------------------------------------------------
|
| Digunakan untuk menampilkan file/foto dari:
|
| storage/app/public
|
| Catatan:
| File e-book berbayar TIDAK menggunakan route ini.
|
*/
Route::get('/media/{path}', function ($path) {

    $path = str_replace('\\', '/', $path);
    $path = ltrim($path, '/');


    if (str_starts_with($path, 'public/')) {

        $path = substr(
            $path,
            strlen('public/')
        );

    }


    if (str_starts_with($path, 'storage/')) {

        $path = substr(
            $path,
            strlen('storage/')
        );

    }


    /*
    |--------------------------------------------------------------------------
    | SECURITY
    |--------------------------------------------------------------------------
    */
    if (str_contains($path, '..')) {

        abort(403);

    }


    $fullPath = storage_path(
        'app/public/' . $path
    );


    if (! File::exists($fullPath)) {

        abort(404);

    }


    return response()->file(
        $fullPath
    );

})
->where('path', '.*')
->name('media.show');


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    if (auth()->user()->role === 'admin') {

        return view(
            'admin.dashboard'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */
    $today = now()->toDateString();


    $attendance = Attendance::where(
        'user_id',
        auth()->id()
    )
        ->where(
            'date',
            $today
        )
        ->first();


    $attendances = Attendance::where(
        'user_id',
        auth()->id()
    )
        ->orderBy(
            'date',
            'desc'
        )
        ->orderBy(
            'created_at',
            'desc'
        )
        ->get();


    $workProgresses = WorkProgress::with(
        'files'
    )
        ->whereHas(
            'attendance',
            function ($query) {

                $query->where(
                    'user_id',
                    auth()->id()
                );

            }
        )
        ->latest()
        ->get();


    return view(
        'dashboard',
        compact(
            'attendance',
            'attendances',
            'workProgresses'
        )
    );

})
->middleware([
    'auth',
    'verified'
])
->name('dashboard');


/*
|--------------------------------------------------------------------------
| PUBLIC MANUSCRIPT
|--------------------------------------------------------------------------
|
| Bisa diakses tanpa login.
| Hanya status Published yang ditampilkan oleh controller.
|
*/
Route::get(
    '/manuscript-published',
    [
        ManuscriptController::class,
        'publicPublished'
    ]
)
->name('public.manuscripts');


/*
|--------------------------------------------------------------------------
| PUBLIC BOOKS
|--------------------------------------------------------------------------
*/
Route::get(
    '/buku',
    [
        PublicBookController::class,
        'books'
    ]
)
->name('public.books');


Route::get(
    '/buku-terbit',
    [
        PublicBookController::class,
        'publishedBooks'
    ]
)
->name('public.published-books');


/*
|--------------------------------------------------------------------------
| E-BOOK CHECKOUT
|--------------------------------------------------------------------------
|
| Semua route berikut dapat diakses pembeli tanpa login.
|
*/


/*
|--------------------------------------------------------------------------
| HALAMAN CHECKOUT
|--------------------------------------------------------------------------
*/
Route::get(
    '/ebook/{publishedBook}/checkout',
    [
        EbookCheckoutController::class,
        'show'
    ]
)
->name('ebook.checkout');


/*
|--------------------------------------------------------------------------
| BUAT ORDER E-BOOK
|--------------------------------------------------------------------------
*/
Route::post(
    '/ebook/{publishedBook}/checkout',
    [
        EbookCheckoutController::class,
        'store'
    ]
)
->name('ebook.checkout.store');


/*
|--------------------------------------------------------------------------
| DETAIL ORDER DENGAN TOKEN AMAN
|--------------------------------------------------------------------------
|
| Tidak lagi menggunakan ID seperti:
|
| /ebook-order/4
|
| Sekarang menggunakan token acak 64 karakter.
|
*/
Route::get(
    '/ebook-order/{token}',
    [
        EbookCheckoutController::class,
        'order'
    ]
)
->where(
    'token',
    '[A-Za-z0-9]{64}'
)
->name('ebook.order.show');


/*
|--------------------------------------------------------------------------
| DOWNLOAD E-BOOK
|--------------------------------------------------------------------------
|
| Controller akan memastikan:
|
| - token order valid
| - order sudah PAID
| - file e-book tersedia
|
*/
Route::get(
    '/ebook-order/{token}/download',
    [
        EbookCheckoutController::class,
        'download'
    ]
)
->where(
    'token',
    '[A-Za-z0-9]{64}'
)
->name('ebook.order.download');


/*
|--------------------------------------------------------------------------
| MIDTRANS WEBHOOK
|--------------------------------------------------------------------------
|
| Route ini dipanggil langsung oleh server Midtrans.
|
| Jangan masukkan ke middleware auth.
| Jangan gunakan CSRF pada route ini.
|
*/
Route::post(
    '/midtrans/webhook',
    [
        EbookCheckoutController::class,
        'webhook'
    ]
)
->name('midtrans.webhook');


/*
|--------------------------------------------------------------------------
| USER & ADMIN ROUTES
|--------------------------------------------------------------------------
|
| Semua route di bawah membutuhkan login.
|
*/
Route::middleware([
    'auth'
])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | NOTIFICATION
    |--------------------------------------------------------------------------
    */
    Route::post(
        '/notifications/leave/read',
        [
            LeaveRequestController::class,
            'markLeaveNotificationsAsRead'
        ]
    )
    ->name(
        'notifications.leave.read'
    );


    /*
    |--------------------------------------------------------------------------
    | ATTENDANCE
    |--------------------------------------------------------------------------
    */
    Route::post(
        '/absen-masuk',
        [
            AttendanceController::class,
            'checkIn'
        ]
    )
    ->name(
        'attendance.checkin'
    );


    Route::post(
        '/absen-pulang',
        [
            AttendanceController::class,
            'checkOut'
        ]
    )
    ->name(
        'attendance.checkout'
    );


    /*
    |--------------------------------------------------------------------------
    | WORK PROGRESS
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/progres-kerja',
        [
            WorkProgressController::class,
            'index'
        ]
    )
    ->name(
        'work.progress.index'
    );


    Route::post(
        '/progres-kerja',
        [
            WorkProgressController::class,
            'store'
        ]
    )
    ->name(
        'work.progress.store'
    );


    Route::patch(
        '/progres-kerja/{id}',
        [
            WorkProgressController::class,
            'update'
        ]
    )
    ->name(
        'work.progress.update'
    );


    Route::get(
        '/work-progress',
        function () {

            return redirect()->route(
                'work.progress.index'
            );

        }
    )
    ->name(
        'work.progress.old'
    );


    /*
    |--------------------------------------------------------------------------
    | BOOKS
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/books',
        [
            BookController::class,
            'index'
        ]
    )
    ->name(
        'books.index'
    );


    Route::post(
        '/books',
        [
            BookController::class,
            'store'
        ]
    )
    ->name(
        'books.store'
    );


    Route::patch(
        '/books/{id}',
        [
            BookController::class,
            'update'
        ]
    )
    ->name(
        'books.update'
    );


    Route::delete(
        '/books/{id}',
        [
            BookController::class,
            'destroy'
        ]
    )
    ->name(
        'books.destroy'
    );


    /*
    |--------------------------------------------------------------------------
    | PUBLISHED BOOKS
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/published-books',
        [
            PublishedBookController::class,
            'index'
        ]
    )
    ->name(
        'published-books.index'
    );


    Route::post(
        '/published-books',
        [
            PublishedBookController::class,
            'store'
        ]
    )
    ->name(
        'published-books.store'
    );


    Route::patch(
        '/published-books/{publishedBook}',
        [
            PublishedBookController::class,
            'update'
        ]
    )
    ->name(
        'published-books.update'
    );


    Route::delete(
        '/published-books/{publishedBook}',
        [
            PublishedBookController::class,
            'destroy'
        ]
    )
    ->name(
        'published-books.destroy'
    );


    /*
    |--------------------------------------------------------------------------
    | MANUSCRIPTS
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/manuscripts',
        [
            ManuscriptController::class,
            'index'
        ]
    )
    ->name(
        'manuscripts.index'
    );


    Route::post(
        '/manuscripts',
        [
            ManuscriptController::class,
            'store'
        ]
    )
    ->name(
        'manuscripts.store'
    );


    Route::patch(
        '/manuscripts/{id}',
        [
            ManuscriptController::class,
            'update'
        ]
    )
    ->name(
        'manuscripts.update'
    );


    Route::delete(
        '/manuscripts/{id}',
        [
            ManuscriptController::class,
            'destroy'
        ]
    )
    ->name(
        'manuscripts.destroy'
    );


    /*
    |--------------------------------------------------------------------------
    | LEAVE REQUEST / IZIN
    |--------------------------------------------------------------------------
    */
    Route::post(
        '/izin',
        [
            LeaveRequestController::class,
            'store'
        ]
    )
    ->name(
        'leave.store'
    );


    Route::get(
        '/admin/izin',
        [
            LeaveRequestController::class,
            'adminIndex'
        ]
    )
    ->name(
        'admin.leave.index'
    );


    Route::post(
        '/admin/izin/{id}/approve',
        [
            LeaveRequestController::class,
            'approve'
        ]
    )
    ->name(
        'admin.leave.approve'
    );


    Route::post(
        '/admin/izin/{id}/reject',
        [
            LeaveRequestController::class,
            'reject'
        ]
    )
    ->name(
        'admin.leave.reject'
    );


    /*
    |--------------------------------------------------------------------------
    | ADMIN ATTENDANCE
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/admin/absensi',
        [
            AttendanceController::class,
            'adminAttendance'
        ]
    )
    ->name(
        'admin.attendance.index'
    );


    Route::get(
        '/admin/riwayat-absen/{user}',
        [
            AttendanceController::class,
            'employeeHistory'
        ]
    )
    ->name(
        'admin.attendance.history'
    );


    /*
    |--------------------------------------------------------------------------
    | ADMIN PROGRESS
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/admin/progres',
        [
            AttendanceController::class,
            'adminProgress'
        ]
    )
    ->name(
        'admin.progress.index'
    );


    /*
    |--------------------------------------------------------------------------
    | ADMIN USERS
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/admin/users',
        [
            AdminUserController::class,
            'index'
        ]
    )
    ->name(
        'admin.users.index'
    );


    Route::patch(
        '/admin/users/{user}/role',
        [
            AdminUserController::class,
            'updateRole'
        ]
    )
    ->name(
        'admin.users.updateRole'
    );


    Route::delete(
        '/admin/users/{user}',
        [
            AdminUserController::class,
            'destroy'
        ]
    )
    ->name(
        'admin.users.destroy'
    );


    /*
    |--------------------------------------------------------------------------
    | ADMIN MANUSCRIPTS
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/admin/manuscripts',
        [
            ManuscriptController::class,
            'adminIndex'
        ]
    )
    ->name(
        'admin.manuscripts.index'
    );


    /*
    |--------------------------------------------------------------------------
    | ADMIN BOOKS
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/admin/books',
        [
            BookController::class,
            'adminIndex'
        ]
    )
    ->name(
        'admin.books.index'
    );


    /*
    |--------------------------------------------------------------------------
    | ADMIN PUBLISHED BOOKS
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/admin/published-books',
        [
            PublishedBookController::class,
            'adminIndex'
        ]
    )
    ->name(
        'admin.published-books.index'
    );

});


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware(
    'auth'
)->group(function () {


    Route::get(
        '/profile',
        [
            ProfileController::class,
            'edit'
        ]
    )
    ->name(
        'profile.edit'
    );


    Route::patch(
        '/profile',
        [
            ProfileController::class,
            'update'
        ]
    )
    ->name(
        'profile.update'
    );


    Route::delete(
        '/profile',
        [
            ProfileController::class,
            'destroy'
        ]
    )
    ->name(
        'profile.destroy'
    );

});


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';