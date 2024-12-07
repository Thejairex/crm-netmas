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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/kyc', [KYCController::class, 'index'])->name('kyc.manage');
    // Route::post('/kyc', [KYCController::class, 'store'])->name('kyc.store');
    // Route::get('/linked-accounts', [LinkedAccountsController::class, 'index'])->name('linked-accounts.index');
    // Route::post('/linked-accounts', [LinkedAccountsController::class, 'store'])->name('linked-accounts.store');
});

require __DIR__.'/auth.php';
require __DIR__.'/api.php';
