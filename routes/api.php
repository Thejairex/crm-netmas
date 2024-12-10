<?php

use App\Http\Controllers\KYCController;
use App\Http\Controllers\LinkedAccountController;
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