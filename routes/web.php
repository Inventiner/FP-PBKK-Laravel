<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/product', function () {
    return view('product');
});