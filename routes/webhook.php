<?php

use App\Http\Controllers\MercadoPagoController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

// MercadoPago Webhook
Route::post('/mercadopago/webhook', [MercadoPagoController::class, 'webhook'])->name('mercadopago.webhook')->withoutMiddleware(VerifyCsrfToken::class);
