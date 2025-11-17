<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Payment Status API - Cho phép user check trạng thái thanh toán
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/payments/{booking}/payos/start', [PaymentApiController::class, 'startPayOS'])
        ->name('api.payments.payos.start');

    Route::get('/payments/{payment}/status', [PaymentApiController::class, 'status'])
        ->name('api.payments.status');
});
