<?php

use App\Livewire\Cart;
use App\Livewire\ProductList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('products')
        : view('welcome');
});


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::middleware(['auth'])->group(function () {
    Route::get('/products', ProductList::class)->name('products');
    Route::get('/cart', Cart::class)->name('cart');
});

require __DIR__.'/auth.php';
