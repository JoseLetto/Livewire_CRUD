<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ProductCrud;

// Redirect root URL to the products index
Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('/products', function () {
    return view('products.index');
})->name('products.index');
