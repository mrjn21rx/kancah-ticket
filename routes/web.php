<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROUTE AUTH USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // USER boleh lihat event
    Route::get('/events', [EventController::class, 'index'])->name('events.index');

    // USER beli tiket
    Route::post('/beli-tiket', [TransactionController::class, 'store'])
        ->name('transactions.store');
});

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/transactions',
         [TransactionController::class, 'index'])
        ->name('transactions.index');

    Route::get('/transactions/{id}/verify',
        [TransactionController::class, 'verify'])
        ->name('transactions.verify');

    Route::get('/admin', function () {
        return "HALAMAN ADMIN BERHASIL DIAKSES";
    });

    Route::get('/admin-dashboard',
    [EventController::class, 'dashboard'])
    ->name('admin.dashboard');

    // ADMIN full CRUD
    Route::resource('events', EventController::class)->except(['index']);
});

require __DIR__.'/auth.php';