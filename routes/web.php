<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSessionController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminOrderController;

// Public pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');

// Auth
Route::get('/login',     [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',    [LoginController::class, 'login']);
Route::post('/logout',   [LoginController::class, 'logout'])->name('logout');
Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Shop (browse public, cart/checkout auth)
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::middleware('auth')->group(function () {
    Route::get('/shop/cart',              [ShopController::class, 'cart'])->name('shop.cart');
    Route::post('/shop/cart/{product}',   [ShopController::class, 'addToCart'])->name('shop.addToCart');
    Route::delete('/shop/cart/{product}', [ShopController::class, 'removeFromCart'])->name('shop.removeFromCart');
    Route::get('/shop/checkout',          [ShopController::class, 'checkout'])->name('shop.checkout');
});

// Bookings
Route::middleware('auth')->group(function () {
    Route::get('/booking',          [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/history',  [BookingController::class, 'history'])->name('booking.history');
    Route::get('/booking/{session}',[BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{session}',[BookingController::class, 'store'])->name('booking.store');
});

// Orders
Route::middleware('auth')->group(function () {
    Route::post('/orders',          [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/history',   [OrderController::class, 'history'])->name('orders.history');
});

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('sessions', AdminSessionController::class);
    Route::resource('products', AdminProductController::class);

    Route::get('/bookings',                    [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}',          [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    Route::get('/orders',                  [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}',          [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});