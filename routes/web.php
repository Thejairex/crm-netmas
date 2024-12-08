<?php

use App\Http\Controllers\KYCController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// KYC routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/verification', [KYCController::class, 'create'])->name('kyc.create'); // Route for creating a new KYC entry
    Route::get('/kyc', [KYCController::class, 'index']) // Route for displaying KYC entries for the admin
        ->name('kyc.index')
        ->middleware('admin');
});


require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
