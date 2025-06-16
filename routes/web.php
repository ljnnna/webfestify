<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ======================= ADMIN ROUTES ===========================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/userfest', [UsersController::class, 'index'])->name('user');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::resource('product', ProductController::class);
    Route::get('/home', function () {
        return redirect()->route('home');
    })->name('home');
});

// ======================= CUSTOMER ROUTES ===========================
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/post', [HomeController::class, 'post'])->middleware('admin');

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/save', [ProfileController::class, 'saveAll'])->name('profile.saveAll');
    Route::post('/profile/photo-upload', [ProfileController::class, 'uploadPicture'])->name('profile.uploadPicture');
    Route::get('/profile/rental-information', [ProfileController::class, 'rentalInfo'])->name('profile.rentalInfo');
    Route::get('/profile/rental-history', [ProfileController::class, 'rentalHistory'])->name('profile.rentalHistory');

    // Customer pages
    Route::get('/catalog', [CatalogController::class, 'catalog'])->name('catalog');
    Route::get('/details', [DetailsController::class, 'details'])->name('details');
    Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{slug}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{slug}', [CartController::class, 'remove'])->name('cart.remove');
});


// ======================= AUTH ROUTES ===========================
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

// ======================= SEARCH ===========================
Route::get('/search', [SearchController::class, 'search'])->name('search');

// ======================= STATIC PAGES ===========================
Route::get('/learnmore', fn () => view('pages.customer.learnmore'))->name('learnmore');
Route::get('/tandc', fn () => view('pages.customer.tandc'))->name('tandc');
Route::get('/privacypolice', fn () => view('pages.customer.privacypolice'))->name('privacypolice');
Route::get('/team', fn () => view('team'))->name('team');
Route::get('/contact', fn () => view('contact'))->name('contact');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');


Route::get('/catalog/{category:slug}', [CatalogController::class, 'byCategory'])->name('catalog.category');

Route::get('/catalog/merchandise', [CatalogController::class, 'merchandise'])->name('catalog.merchandise');
Route::get('/catalog/electronics', [CatalogController::class, 'electronics'])->name('catalog.electronics');
Route::get('/catalog/others', [CatalogController::class, 'others'])->name('catalog.others');


// ======================= DEFAULT AUTH ROUTES (Fortify/Breeze/etc.) ===========================
require __DIR__.'/auth.php';

Route::get('/product/{slug}', [ProductController::class, 'detailBySlug'])->name('product.show');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/send', function (Request $request) {
    // Validasi
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|max:20',
        'message' => 'required|max:1000',
    ]);
    
    // Logic untuk mengirim email atau menyimpan ke database
    // Contoh: Mail::to('admin@festify.com')->send(new ContactMessage($request->all()));
    
    return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
})->name('contact.send');
