<?php

use App\Http\Controllers\Usuario\UsuarioController;

Route::prefix('usuarios')->name('usuarios.')->middleware(['auth'])->group(function () {
    
    Route::get('/', [UsuarioController::class, 'index'])->name('index');//->middleware('can:usuarios.index');

    Route::get('/create', [UsuarioController::class, 'create'])->name('create');//->middleware('can:usuarios.create');

    Route::post('/store', [UsuarioController::class, 'store'])->name('store');//->middleware('can:usuarios.create');

    Route::get('/show/{usuario}', [UsuarioController::class, 'show'])->name('show');//->middleware('can:usuarios.show');

    Route::get('/edit/{usuario}', [UsuarioController::class, 'edit'])->name('edit');//->middleware('can:usuarios.edit');

    Route::put('/update', [UsuarioController::class, 'update'])->name('update');//->middleware('can:usuarios.edit');

    Route::delete('/delete', [UsuarioController::class, 'destroy'])->name('destroy');//->middleware('can:usuarios.delete');
    
});