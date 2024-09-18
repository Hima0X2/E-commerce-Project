<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Store messages
Route::post('/store-message', [MessageController::class, 'store'])->name('storeMessage');

// User routes
Route::get('/', function () {
    return view('user.home');
});

Route::get('/home', function () {
    return view('user.home');
})->name('user.home');

Route::view('/products', 'user.products')->name('products');
Route::view('/contact', 'user.contact')->name('contact');
Route::view('/about', 'user.about')->name('about');

// User login routes
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);

// Authenticated user redirect route
Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect')->middleware('auth');

// User product routes
Route::get('/products', [ProductController::class, 'index'])->name('products');

// Cart routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/confirm', [CartController::class, 'confirm'])->name('cart.confirm');

// Route to show the login form
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');

// Route to handle the login form submission
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Apply authentication middleware to admin routes
Route::middleware('auth:admin')->group(function() {
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

});

// Admin Logout Route
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
