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
use App\Http\Controllers\ReturnProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// ======================= ADMIN ROUTES ===========================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/userfest', [UsersController::class, 'index'])->name('user');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::post('/orders/{id}/condition', [OrderController::class, 'uploadCondition'])->name('orders.uploadCondition');
    Route::get('/returns', [ReturnProductController::class, 'index'])->name('returns');
    Route::post('/returns/{id}/upload-condition', [ReturnProductController::class, 'uploadCondition'])->name('returns.uploadCondition');
    Route::put('/returns/{id}/status', [ReturnProductController::class, 'updateStatus'])->name('returns.updateStatus');
    Route::put('/returns/{id}/notes', [ReturnProductController::class, 'updateNotes'])->name('returns.updateNotes');
    Route::post('/returns/create/{orderId}', [ReturnProductController::class, 'createReturn'])->name('returns.createReturn');
    Route::put('/returns/confirm/{returnId}', [ReturnProductController::class, 'confirmReturn'])->name('returns.confirmReturn');
    Route::resource('product', ProductController::class);
    Route::delete('/product/{product}/image/{imageId}', [ProductController::class, 'deleteImage'])->name('product.image.destroy');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/home', function () {
        return redirect()->route('home');
    })->name('home');
});

// ======================= CUSTOMER ROUTES ===========================
Route::get('/details/{slug}', [ProductController::class, 'detailBySlug'])->name('product.details');
Route::post('rent-now', [ProductController::class, 'processRentNow'])->name('rent.now');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/post', [HomeController::class, 'post'])->middleware('admin');
    // Profile
    //Route::post('/profile/verify', [ProfileController::class, 'verify'])->name('profile.verify');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/save', [ProfileController::class, 'saveAll'])->name('profile.saveAll');
    Route::post('/profile/photo-upload', [ProfileController::class, 'uploadPicture'])->name('profile.uploadPicture');
    Route::get('/profile/rental-information', [ProfileController::class, 'rentalInfo'])->name('profile.rentalInfo');
    Route::get('/profile/rental-history', [ProfileController::class, 'rentalHistory'])->name('profile.rentalHistory');
    Route::post('/return/create/{order}', [ReturnProductController::class, 'createReturn'])->name('return.create');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
    Route::post('/profile/verify', [ProfileController::class, 'verify'])->name('profile.verify');
    Route::post('/return/upload/{id}', [ReturnProductController::class, 'uploadCondition'])->name('return.upload-photos');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/return/pickup/{order}', function ($orderId) {
        $order = \App\Models\Order::with('products')->findOrFail($orderId);
        return view('returns.pickup', compact('order'));
    })->name('return.pickup.view');

    Route::get('/return/dropoff/{order}', function ($orderId) {
        $order = \App\Models\Order::with('products')->findOrFail($orderId);
        return view('returns.dropoff', compact('order'));
    })->name('return.dropoff.view');


    //Details
    Route::get('/details', [DetailsController::class, 'details'])->name('details');

    // Display payment page
    Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/finish', [PaymentController::class, 'paymentFinish'])->name('payment.finish');
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CartController::class, 'paymentPage'])->name('checkout.process');

    //Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{slug}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{slug}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{slug}', [CartController::class, 'update'])->name('cart.update');
});

// Payment notification from Midtrans (webhook)
Route::post('/payment/notification', [PaymentController::class, 'paymentNotification'])
    ->name('payment.notification')
    ->withoutMiddleware(['web']); // Remove CSRF protection for webhook

Route::get('/order/success/{orderCode}', function($orderCode) {
    $order = \App\Models\Order::where('order_code', $orderCode)->first();
    if (!$order) {
        return redirect()->route('home')->with('error', 'Order not found');
    }
    return view('pages.customer.order-success', compact('order'));
})->name('order.success')->middleware('auth');


// ======================= AUTH ROUTES ===========================
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::get('/register', fn () => view('auth.register'))->name('register');
});

// ======================= SEARCH ===========================
Route::get('/search/name', [SearchController::class, 'searchByName'])->name('search.name');
Route::get('/search/result', [SearchController::class, 'search'])->name('search.result');

// ======================= STATIC PAGES ===========================
Route::get('/learnmore', fn () => view('pages.customer.learnmore'))->name('learnmore');
Route::get('/tandc', fn () => view('pages.customer.tandc'))->name('tandc');
Route::get('/privacypolice', fn () => view('pages.customer.privacypolice'))->name('privacypolice');
Route::get('/team', fn () => view('team'))->name('team');
Route::get('/contact', fn () => view('contact'))->name('contact');

//Catalog
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
