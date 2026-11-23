<?php

use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('products', 'pages::products.index') ->name('products');
    Route::livewire('create', 'pages::products.create') ->name('create');
    //Route::livewire('edit', 'pages::products.edit') ->name('edit');
    Route::livewire('products/{product}/edit','pages::products.edit')->name('products.edit');

    //rute data pelangan
    Route::livewire('DataPeangan','pages::-data-pelangan.index')->name('DataPelanggan');

    });

require __DIR__.'/settings.php';