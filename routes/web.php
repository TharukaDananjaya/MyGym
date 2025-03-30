<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduledClassController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
// dashboard routes
Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::get('/instructor/dashboard', function () {
    return Inertia::render('Instructor/Dashboard');
})->middleware(['auth', 'role:instructor'])->name('instructor.dashboard');



Route::get('/admin/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

Route::resource('instructor/schedule', ScheduledClassController::class)
    ->only('index', 'create', 'store', 'destroy')
    ->middleware(['auth', 'role:instructor']);

/* Member routes */
Route::middleware('auth', 'role:member')->group(function () {
    Route::get('/member/dashboard', function () {
        return Inertia::render('Member/Dashboard');
    })->name('member.dashboard');
    Route::get('/member/book', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/member/bookings', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/member/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::delete('/member/bookings/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
