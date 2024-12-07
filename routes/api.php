<?php

use App\Http\Controllers\KYCController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
   Route::post('/link-account', [KYCController::class, 'store']); // Route for linking accounts for the user
   Route::get('/kyc', [KYCController::class, 'show']);
});

Route::middleware('auth', 'admin')->group(function () {
    Route::post('/verify-account/{linked_account_id}', [KYCController::class, 'update']); // Route for approving accounts for the admin
});