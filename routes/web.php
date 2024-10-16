<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['products' => Product::where('user_id', Auth::id())->get(), 'categories' => Category::all()]);
})->middleware(['auth'])->name('dashboard');
Route::post('/dashboard', [ProductController::class, 'store'])->middleware(['auth'])->name('products.store');


Route::get('/store', function () {
    return view('store', ['products' => Product::where('user_id', '!=', Auth::id())->get()]);
})->middleware(['auth'])->name('store');

Route::get('/categories', function () {
    return view('categories');
})->middleware(['auth'])->name('categories');

Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
 
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'removeItem'])->name('cart.remove');
});

Route::get('/update-cart-navbar', function () {
    return view('partials.cart-navbar');
})->name('cart.update-navbar');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';