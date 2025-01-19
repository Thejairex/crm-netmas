<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\CartController;
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
    // Route for linking accounts for the user
    Route::post('/link-account', [LinkedAccountController::class, 'store']);

    // Route for storing KYC entries for the user
    Route::post('/kyc/store', [KYCController::class, 'store'])
        ->name('kyc.store');

    Route::post('/imei-validation', [ImeiValidationController::class, 'store'])->name('validation.store');

    Route::post('/purchases/{id}', [PurchaseController::class, 'store'])->name('purchases.store'); // Route for creating a new transaction

    Route::post('/support/store', [SupportTicketController::class, 'store'])->name('support.store'); // Route for creating a new support ticket

    Route::prefix('cart')->group(function () {
        Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add'); // Route for adding a product to the cart
        Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); // Route for paying for the cart
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove'); // Route for removing a product from the cart
        Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear'); // Route for clearing the cart
    });
});

// Backoffice API routes
Route::prefix('backoffice')->name('backoffice.')->middleware(['auth', 'admin'])->group(function () {
    // KYC API routes
    Route::patch('/kyc/update/{id}', [KYCController::class, 'update'])->name('kyc.update');
    Route::delete('/kyc/destroy/{id}', [KYCController::class, 'destroy'])->name('kyc.destroy');

    // User API routes
    Route::put('/users/{id}', [BackOfficeController::class, 'userUpdate'])->name('users.update');
    Route::delete('/users/{id}', [BackOfficeController::class, 'userDestroy'])->name('users.destroy');

    // Product API routes
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Route for creating a new service
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Route for updating a service
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Route for deleting a service

    // Transaction API routes
    Route::put('/purchases/{id}', [PurchaseController::class, 'update'])->name('purchases.update'); // Route for updating a transaction
    Route::delete('/purchases/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy'); // Route for deleting a transaction

    // Support API routes
    Route::put('/support/{id}', [SupportTicketController::class, 'update'])->name('support.update'); // Route for updating a support ticket
    Route::delete('/support/{id}', [SupportTicketController::class, 'destroy'])->name('support.destroy'); // Route for deleting a support ticket
    Route::post('/support/assign/{id}', [SupportTicketController::class, 'assign'])->name('support.assign'); // Route for assigning a support ticket

    // Educational Resource API routes
    Route::post('/educational-resources', [EducationalResourceController::class, 'store'])->name('educational-resources.store'); // Route for creating a new educational resource
    Route::put('/educational-resources/{id}', [EducationalResourceController::class, 'update'])->name('educational-resources.update'); // Route for updating an educational resource
    Route::delete('/educational-resources/{id}', [EducationalResourceController::class, 'destroy'])->name('educational-resources.destroy'); // Route for deleting an educational resource
});
