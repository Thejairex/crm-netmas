<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\KYCController;
use App\Http\Controllers\LinkedAccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;



// User API routes
Route::middleware('auth')->group(function () {
   Route::post('/link-account', [LinkedAccountController::class, 'store']); // Route for linking accounts for the user

   Route::post('/kyc/store', [KYCController::class, 'store']); // Route for storing KYC entries for the user
    // Route for updating KYC entries for the user

});

// Backoffice API routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::patch('/backoffice/kyc/update/{id}', [KYCController::class, 'update'])->name('kyc.update'); // Route for updating KYC entries
    Route::delete('/backoffice/kyc/destroy/{id}', [KYCController::class, 'destroy'])->name('kyc.destroy'); // Route for deleting KYC entries
    Route::put('/backoffice/users/{id}', [BackOfficeController::class, 'userUpdate'])->name('backoffice.users.update');
    Route::delete('/backoffice/users/{id}', [BackOfficeController::class, 'userDestroy'])->name('backoffice.users.destroy');
});

// Service API routes
Route::middleware('auth')->group(function () {
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Route for creating a new service
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Route for updating a service
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Route for deleting a service

    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store'); // Route for creating a new transaction
    Route::put('/purchases/{id}', [PurchaseController::class, 'update'])->name('purchases.update'); // Route for updating a transaction
    Route::delete('/purchases/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy'); // Route for deleting a transaction
});

// Purchase API routes
Route::middleware('auth')->group(function () {
    Route::delete('/purchases/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy'); // Route for deleting a transaction
});
