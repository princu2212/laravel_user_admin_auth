<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// Admin Route
Route::controller(AuthenticatedSessionController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', 'create')->name('login');
    Route::post('login', 'store')->name('adminlogin');
    Route::post('logout', 'destroy')->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    });
});
