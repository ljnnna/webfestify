<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

// Admin ----------------------------------------------------------------

// Route::get('/dashboardfest', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/userfest', function () {
    return view('admin.admincostumer');
})->name('admin.user');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('product', ProductController::class);
});


// Customer -------------------------------------------------------------



Route::prefix('admin')->group(function () {
    Route::resource('product', ProductController::class);
});

Route::get('/orders', function () {
    return view('admin.orders');
});
// Customer -------------------------------------------------------------

// Route::get('/dashboard', [HomeController::class, 'index'])
// ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth'])
    ->name('home');

Route::get('post', [HomeController::class, 'post'])->middleware(['auth', 'admin']);

Route::get('/users', [UsersController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/save', [ProfileController::class, 'saveAll'])->name('profile.saveAll');
    Route::post('/profile/photo-upload', [ProfileController::class, 'uploadPicture'])->name('profile.uploadPicture');
});

Route::put('/profile/save-all', [ProfileController::class, 'saveAll'])->name('profile.saveAll');
Route::post('/profile/picture-upload', [ProfileController::class, 'uploadPicture'])->name('profile.picture');
Route::get('/profile/rental-information', [ProfileController::class, 'rentalInfo'])->name('profile.rentalInfo');
Route::get('/profile/rental-history', [ProfileController::class, 'rentalHistory'])->name('profile.rentalHistory');


// Proses login
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Proses register
Route::post('/register', [RegisteredUserController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::get('/katalogmerch', function () {
    return view('customer.katalog_merch');
});

Route::get('/learnmore', function () {
    return view('learnmore');
});


Route::get('/team', function () {
    return view('team');
});

Route::get('/catalog', [CatalogController::class, 'catalog']);

// Route::get('/home', function () {
//     return view('homepage');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/searchpage', function () {
    return view('pages.customer.searchpage');
});

Route::get('/catalog', [CatalogController::class, 'catalog']);

Route::get('/details', [DetailsController::class, 'details'])->name('details');

Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');


Route::get('/cart', function () {
    return view('pages.customer.cart-page');
});

Route::get('/admin/home', function () {
    return redirect()->route('home');
})->name('admin.home');


require __DIR__.'/auth.php';
