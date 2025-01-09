<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\EducationalResourceController;
use App\Http\Controllers\ImeiValidationController;
use App\Http\Controllers\KYCController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Product routes
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
    Route::get('/profile/tree', [ProfileController::class, 'tree'])->name('profile.tree');
});

// Backoffice routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/backoffice', [BackOfficeController::class, 'index'])->name('backoffice.index');

    // Backoffice users
    Route::get('/backoffice/users', [BackOfficeController::class, 'users'])->name('backoffice.users');
    Route::get('/backoffice/users/new', [BackOfficeController::class, 'userCreate'])
        ->name('backoffice.users.create');
    Route::get('/backoffice/users/{id}', [BackOfficeController::class, 'userEdit'])->name('backoffice.users.edit');

    // Backoffice purchases
    Route::get('/backoffice/purchases', [PurchaseController::class, 'index'])->name('purchases.index');

    // Backoffice KYC
    Route::get('/backoffice/kyc', [KYCController::class, 'index'])->name('kyc.index'); // Route for listing KYC entries
    Route::get('/backoffice/kyc/{id}', [KYCController::class, 'show'])->name('kyc.show'); // Route for showing a specific KYC entry

    // Backoffice Supports
    Route::get('/backoffice/support', [SupportTicketController::class, 'index'])->name('support.index');

    // Imei validation routes
    Route::get('/backoffice/imei-validation', [ImeiValidationController::class, 'index'])->name('validation.index');
});

// User routes
Route::middleware('auth')->group(function () {
    // Support routes
    Route::get('/support', [SupportTicketController::class, 'create'])->name('support.create');
    Route::get('/support/{id}', [SupportTicketController::class, 'show'])->name('support.show');

    // Payment routes
    Route::get('payment/success', [MercadoPagoController::class, 'success'])->name('payment.success');
    Route::get('payment/failure', [MercadoPagoController::class, 'failure'])->name('payment.failure');
    Route::get('payment/pending', [MercadoPagoController::class, 'pending'])->name('payment.pending');

    // Imei validation routes
    Route::get('/imei-validation', [ImeiValidationController::class, 'create'])->name('validation.create');

    // Education routes
    Route::get('/education', [EducationalResourceController::class, 'index'])->name('educational-resources.index');
    Route::get('/education/create', [EducationalResourceController::class, 'create'])->name('educational-resources.create');
    Route::get('/education/{id}', [EducationalResourceController::class, 'show'])->name('educational-resources.show');

    // event routes
    Route::get('/events', [TicketController::class, 'index'])->name('events.index');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
require __DIR__ . '/webhook.php';
