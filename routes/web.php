<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
   return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
//->middleware('auth')->name('dashboard');

Route::get('/cartpage', function () {
   return view('cartpage');
});

Route::get('/halaman_pencarian', function () {
   return view('halaman_pencarian');
});

Route::get('/detailsproductcatalogcust', function () {
   return view('detailsproductcataogcust');
});



