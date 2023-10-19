<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('orders')->controller(OrderController::class)->group(function () {
    Route::post('/search', 'list')->name('orders.search');
    Route::post('/create', 'create')->name('orders.create');
    Route::post('/update', 'updateStatus')->name('orders.status.update');
});
