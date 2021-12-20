<?php

use App\Http\Controllers\Permiso\PermisoController;
use Illuminate\Support\Facades\Route;

Route::prefix('permiso')->name('permisos.')->middleware(['auth'])->group(function () {
    
    Route::get('/', [PermisoController::class, 'index'])->name('index');//->middleware('can:productos.index');

    Route::get('/create', [PermisoController::class, 'create'])->name('create');//->middleware('can:productos.create');

    Route::post('/store', [PermisoController::class, 'store'])->name('store');//->middleware('can:productos.create');

    Route::get('/show/{permiso}', [PermisoController::class, 'show'])->name('show');//->middleware('can:productos.show');

    Route::get('/edit/{permiso}', [PermisoController::class, 'edit'])->name('edit');//->middleware('can:productos.edit');

    Route::put('/update/{permiso}', [PermisoController::class, 'update'])->name('update');//->middleware('can:productos.edit');

    Route::delete('/delete', [PermisoController::class, 'destroy'])->name('destroy');//->middleware('can:productos.delete');
    
});