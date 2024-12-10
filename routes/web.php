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
    
});

// Backoffice routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/backoffice/kyc', [KYCController::class, 'index'])->name('kyc.index'); // Route for listing KYC entries
    Route::get('/backoffice/kyc/{id}', [KYCController::class, 'show'])->name('kyc.show'); // Route for showing a specific KYC entry
});
require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
