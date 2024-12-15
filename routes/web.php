<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\KYCController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Service routes
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/purchases/create/{id}', [PurchaseController::class, 'create'])->name('purchases.create');
});


// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/verification', [KYCController::class, 'create'])->name('kyc.create');
});

// Backoffice routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/backoffice', [BackOfficeController::class, 'index'])->name('backoffice.index');

    // Backoffice users
    Route::get('/backoffice/users', [BackOfficeController::class, 'users'])->name('backoffice.users');
    Route::get('/backoffice/users/{id}', [BackOfficeController::class, 'userEdit'])->name('backoffice.users.edit');


    // Backoffice products and purchases
    Route::get('/backoffice/products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/backoffice/purchases', [PurchaseController::class, 'index'])->name('purchases.index');

    // Backoffice KYC
    Route::get('/backoffice/kyc', [KYCController::class, 'index'])->name('kyc.index'); // Route for listing KYC entries
    Route::get('/backoffice/kyc/{id}', [KYCController::class, 'show'])->name('kyc.show'); // Route for showing a specific KYC entry

});
require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
