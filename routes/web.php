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

Route::get('/store', function () {
    return view('store', ['products' => Product::where('user_id', '!=', Auth::id())->get()]);
})->middleware(['auth'])->name('store');

Route::get('/category/{slug}', function ($slug) {
    $products = Product::where('user_id', '!=', Auth::id())
                        ->whereHas('category', function ($query) use ($slug) {
                            $query->where('slug', $slug);
                        })
                        ->get();
    return view('product.filter', ['products' => $products, 'category' => $slug]);
})->middleware(['auth']);

Route::get('/store/{slug}', function ($slug) {
    $product = Product::where('slug', '=', $slug)->first();
    return view('product.detail', ['product' => $product]);
})->middleware(['auth']);

Route::get('/categories', function () {
    return view('categories', ['categories' => Category::All()]);
})->middleware(['auth'])->name('categories');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/upload', [ProductController::class, 'upload']);
    Route::get('/dashboard/edit/{slug}', [ProductController::class, 'edit']);

    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/dashboard/create', [ProductController::class, 'store'])->name('products.store');

    Route::put('/dashboard/update', [ProductController::class, 'update'])->name('products.update');
    
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/dashboard/delete', [ProductController::class, 'destroy'])->name('products.destroy');
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