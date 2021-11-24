<?php

use App\Http\Controllers\Nacionalidad\NacionalidadController;
use Illuminate\Support\Facades\Route;

Route::prefix('nacionalidades')->name('nacionalidades.')->middleware(['auth'])->group(function () {
    
    Route::get('/', [NacionalidadController::class, 'index'])->name('index');//->middleware('can:nacionalidades.index');

    Route::get('/create', [NacionalidadController::class, 'create'])->name('create');//->middleware('can:nacionalidades.create');

    Route::post('/store', [NacionalidadController::class, 'store'])->name('store');//->middleware('can:nacionalidades.create');

    Route::get('/show/{nacionalidad}', [NacionalidadController::class, 'show'])->name('show');//->middleware('can:nacionalidades.show');

    Route::get('/edit/{nacionalidad}', [NacionalidadController::class, 'edit'])->name('edit');//->middleware('can:nacionalidades.edit');

    Route::put('/update', [NacionalidadController::class, 'update'])->name('update');//->middleware('can:nacionalidades.edit');

    Route::delete('/delete', [NacionalidadController::class, 'destroy'])->name('destroy');//->middleware('can:nacionalidades.delete');
    
});