<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\EducationalResourceController;
use App\Http\Controllers\ImeiValidationController;
use App\Http\Controllers\KYCController;
use App\Http\Controllers\LinkedAccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupportTicketController;
use Illuminate\Support\Facades\Route;



// User API routes
Route::middleware('auth')->group(function () {
    Route::post('/link-account', [LinkedAccountController::class, 'store']); // Route for linking accounts for the user

    Route::post('/kyc/store', [KYCController::class, 'store']); // Route for storing KYC entries for the user
    // Route for updating KYC entries for the user

    Route::post('/imei-validation', [ImeiValidationController::class, 'store'])->name('validation.store');

});

// Backoffice API routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::patch('/backoffice/kyc/update/{id}', [KYCController::class, 'update'])->name('kyc.update'); // Route for updating KYC entries
    Route::delete('/backoffice/kyc/destroy/{id}', [KYCController::class, 'destroy'])->name('kyc.destroy'); // Route for deleting KYC entries
    Route::put('/backoffice/users/{id}', [BackOfficeController::class, 'userUpdate'])->name('backoffice.users.update');
    Route::delete('/backoffice/users/{id}', [BackOfficeController::class, 'userDestroy'])->name('backoffice.users.destroy');
});

// Product API routes
Route::middleware('auth')->group(function () {
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Route for creating a new service
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Route for updating a service
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Route for deleting a service

    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store'); // Route for creating a new transaction
    Route::put('/purchases/{id}', [PurchaseController::class, 'update'])->name('purchases.update'); // Route for updating a transaction
    Route::delete('/purchases/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy'); // Route for deleting a transaction
});

// Support API routes
Route::middleware('auth')->group(function () {
    Route::post('/support/store', [SupportTicketController::class, 'store'])->name('support.store'); // Route for creating a new support ticket
    Route::put('/support/{id}', [SupportTicketController::class, 'update'])->name('support.update'); // Route for updating a support ticket
    Route::delete('/support/{id}', [SupportTicketController::class, 'destroy'])->name('support.destroy'); // Route for deleting a support ticket
    Route::post('/support/assign/{id}', [SupportTicketController::class, 'assign'])->name('support.assign'); // Route for assigning a support ticket
});

// Educational Resource API routes
Route::middleware('auth')->group(function () {
    Route::post('/educational-resources', [EducationalResourceController::class, 'store'])->name('educational-resources.store'); // Route for creating a new educational resource
    Route::put('/educational-resources/{id}', [EducationalResourceController::class, 'update'])->name('educational-resources.update'); // Route for updating an educational resource
    Route::delete('/educational-resources/{id}', [EducationalResourceController::class, 'destroy'])->name('educational-resources.destroy'); // Route for deleting an educational resource
});
