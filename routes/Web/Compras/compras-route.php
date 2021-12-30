<?php

use App\Http\Controllers\Compra\CompraController;
use Illuminate\Support\Facades\Route;

Route::prefix('compras')->name('compras.')->middleware(['auth'])->group(function () {
    
    Route::get('/', [CompraController::class, 'index'])->name('index');//->middleware('can:compras.index');

    Route::get('/create', [CompraController::class, 'create'])->name('create');//->middleware('can:compras.create');

    Route::post('/store', [CompraController::class, 'store'])->name('store');//->middleware('can:compras.create');

    Route::get('/show/{compra}', [CompraController::class, 'show'])->name('show');//->middleware('can:compras.show');

    Route::get('/edit/{compra}', [CompraController::class, 'edit'])->name('edit');//->middleware('can:compras.edit');

    Route::put('/update/{compra}', [CompraController::class, 'update'])->name('update');//->middleware('can:compras.edit');

    Route::delete('/delete', [CompraController::class, 'destroy'])->name('destroy');//->middleware('can:compras.delete');
    
});