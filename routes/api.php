<?php

use App\Http\Controllers\KYCController;
use App\Http\Controllers\LinkedAccountController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;



// User API routes
Route::middleware('auth')->group(function () {
   Route::post('/link-account', [LinkedAccountController::class, 'store']); // Route for linking accounts for the user

   Route::post('/kyc/store', [KYCController::class, 'store']); // Route for storing KYC entries for the user
    // Route for updating KYC entries for the user
   
});

// Admin API routes
Route::middleware('auth', 'admin')->group(function () {
   Route::patch('/kyc/update/{id}', [KYCController::class, 'update'])->name('kyc.update'); // Route for updating KYC entries for the admin
   Route::delete('/kyc/destroy/{id}', [KYCController::class, 'destroy'])->name('kyc.destroy'); // Route for deleting KYC entries for the admin
});

// Service API routes
Route::middleware('auth')->group(function () {
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store'); // Route for creating a new service
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update'); // Route for updating a service
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy'); // Route for deleting a service

    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store'); // Route for creating a new transaction
});