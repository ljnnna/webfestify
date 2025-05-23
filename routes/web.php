<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Admin ----------------------------------------------------------------

use App\Http\Controllers\DashboardController;

Route::get('/dashboardfest', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/userfest', function () {
    return view('admin.admincostumer');
});

use App\Http\Controllers\ProductController;

Route::prefix('admin')->group(function () {
    Route::resource('product', ProductController::class);
});

// Customer -------------------------------------------------------------


Route::get('/users', [UsersController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/save', [ProfileController::class, 'saveAll'])->name('profile.saveAll');
    Route::post('/profile/photo-upload', [ProfileController::class, 'uploadPicture'])->name('profile.uploadPicture');
});


// Proses login
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Proses register
Route::post('/register', [RegisteredUserController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::get('/home', function () {
    return view('customer.homepage');
});

Route::get('/katalogmerch', function () {
    return view('customer.katalog_merch');
});

Route::get('/learnmore', function () {
    return view('learnmore');
});

Route::get('/home', function () {
    return view('homepage');
});

Route::get('/searchpage', function () {
    return view('pages.customer.searchpage');
});

Route::get('/cartpage', function () {
    return view('customer.cartpage');
});
                                                                                                                                                                                         
Route::get('/paymentcust', function () {
    return view('customer.paymentcust');
});

Route::get('/detailsproduct', function () {
    return view('customer.detailsproductcatalogcust');
});

Route::get('/team', function () {
    return view('team');
});

Route::get('/catalog', [CatalogController::class, 'catalog']);

Route::get('/home', function () {
    return view('homepage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/payment', [PaymentController::class, 'payment']);

Route::get('/details', [DetailsController::class, 'details']);

Route::put('/profile/save-all', [ProfileController::class, 'saveAll'])->name('profile.saveAll');
Route::post('/profile/picture-upload', [ProfileController::class, 'uploadPicture'])->name('profile.picture');
Route::get('/profile/rental-information', [ProfileController::class, 'rentalInfo'])->name('profile.rentalInfo');
Route::get('/profile/rental-history', [ProfileController::class, 'rentalHistory'])->name('profile.rentalHistory');

