<?php

use Illuminate\Support\Facades\Route;

use Livewire\Volt\Volt;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    });

Route::view('products', 'pages.products.index')
    ->middleware(['auth'])
    ->name('products');

require __DIR__.'/settings.php';