<?php

use App\Http\Controllers\Proveedor\ProveedorController;
use Illuminate\Support\Facades\Route;

Route::prefix('proveedores')->name('proveedores.')->middleware(['auth'])->group(function () {
    
    Route::get('/', [ProveedorController::class, 'index'])->name('index');//->middleware('can:usuarios.index');

    Route::get('/create', [ProveedorController::class, 'create'])->name('create');//->middleware('can:usuarios.create');

    Route::post('/store', [ProveedorController::class, 'store'])->name('store');//->middleware('can:usuarios.create');

    Route::get('/show/{proveedor}', [ProveedorController::class, 'show'])->name('show');//->middleware('can:usuarios.show');

    Route::get('/edit/{proveedor}', [ProveedorController::class, 'edit'])->name('edit');//->middleware('can:usuarios.edit');

    Route::put('/update', [ProveedorController::class, 'update'])->name('update');//->middleware('can:usuarios.edit');

    Route::delete('/delete', [ProveedorController::class, 'destroy'])->name('destroy');//->middleware('can:usuarios.delete');
    
});