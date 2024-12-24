<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/create-razorpay-order-id', [PaymentController::class, 'create_razorpay_order_id'])->middleware(['auth:sanctum']);
Route::post('/verify-razorpay-payment', [PaymentController::class, 'verify_razorpay_payment'])->middleware(['auth:sanctum']);
Route::post('/razorpay-webhook', [PaymentController::class, 'razorpay_webhook']);
