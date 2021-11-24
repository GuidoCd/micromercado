<?php

use App\Http\Controllers\Producto\ProductoController;
use Illuminate\Support\Facades\Route;

Route::prefix('productos')->name('productos.')->middleware(['auth'])->group(function () {
    
    Route::get('/', [ProductoController::class, 'index'])->name('index');//->middleware('can:productos.index');

    Route::get('/create', [ProductoController::class, 'create'])->name('create');//->middleware('can:productos.create');

    Route::post('/store', [ProductoController::class, 'store'])->name('store');//->middleware('can:productos.create');

    Route::get('/show/{producto}', [ProductoController::class, 'show'])->name('show');//->middleware('can:productos.show');

    Route::get('/edit/{producto}', [ProductoController::class, 'edit'])->name('edit');//->middleware('can:productos.edit');

    Route::put('/update/{producto}', [ProductoController::class, 'update'])->name('update');//->middleware('can:productos.edit');

    Route::delete('/delete', [ProductoController::class, 'destroy'])->name('destroy');//->middleware('can:productos.delete');
    
});