<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RentalHistoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route untuk rental history
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/rental-history', [RentalHistoryController::class, 'index']);
    Route::get('/rental-history/{id}', [RentalHistoryController::class, 'show']);
});

// Jika tidak menggunakan authentication middleware:
// Route::get('/rental-history/{userId}', [RentalHistoryController::class, 'getUserRentalHistory']);

// Route untuk testing (bisa dihapus setelah selesai development)
Route::get('/test-rental-history/{userId}', [RentalHistoryController::class, 'testGetRentalHistory']);