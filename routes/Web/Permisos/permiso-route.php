<?php

use App\Http\Controllers\Permiso\PermisoController;
use Illuminate\Support\Facades\Route;

Route::prefix('permisos')->name('permisos.')->middleware(['auth'])->group(function () {
    Route::get('/', [PermisoController::class, 'index'])->name('index')->middleware('can:permisos.index');
    Route::get('/create', [PermisoController::class, 'create'])->name('create')->middleware('can:permisos.create');
    Route::post('/store', [PermisoController::class, 'store'])->name('store')->middleware('can:permisos.create');
    Route::get('/show/{permiso}', [PermisoController::class, 'show'])->name('show')->middleware('can:permisos.show');
    Route::get('/edit/{permiso}', [PermisoController::class, 'edit'])->name('edit')->middleware('can:permisos.edit');
    Route::put('/update/{permiso}', [PermisoController::class, 'update'])->name('update')->middleware('can:permisos.edit');
    Route::delete('/delete', [PermisoController::class, 'destroy'])->name('destroy')->middleware('can:permisos.delete');
});