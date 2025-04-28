<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

<<<<<<< HEAD
Route::get('/halaman_pencarian', function () {
   return view('halaman_pencarian');
});

Route::get('/detailsproductcatalogcust', function () {
   return view('detailsproductcataogcust');
});



=======
require __DIR__.'/auth.php';
>>>>>>> f38462f579100675f2d9ab345e3e76b23fec9d4d
