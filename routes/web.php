<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cartpage', function () {
    return view('cart');
});

Route::get('/detailsproductcatalogcust', function () {
    return view('detailsproductcatalogcust');
});

// Route ke form login
Route::get('/login', function () {
    return view('login'); // view login buatanmu
})->name('login');

// Route ke form register
Route::get('/register', function () {
    return view('register'); // view register buatanmu
})->name('register');

// Proses login
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Proses register
Route::post('/register', [RegisteredUserController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);


                                                                                                                                                                                         
