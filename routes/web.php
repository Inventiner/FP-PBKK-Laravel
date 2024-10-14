<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['products' => Product::all()]);
})->middleware(['auth'])->name('dashboard');

Route::get('/store', function () {
    return view('store', ['products' => Product::all()]);
})->middleware(['auth'])->name('store');

Route::get('/categories', function () {
    return view('categories');
})->middleware(['auth'])->name('categories');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';