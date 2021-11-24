<?php

use App\Http\Controllers\Categoria\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::prefix('categorias')->name('categorias.')->middleware(['auth'])->group(function () {
    
    Route::get('/', [CategoriaController::class, 'index'])->name('index');//->middleware('can:usuarios.index');

    Route::get('/create', [CategoriaController::class, 'create'])->name('create');//->middleware('can:usuarios.create');

    Route::post('/store', [CategoriaController::class, 'store'])->name('store');//->middleware('can:usuarios.create');

    Route::get('/show/{categoria}', [CategoriaController::class, 'show'])->name('show');//->middleware('can:usuarios.show');

    Route::get('/edit/{categoria}', [CategoriaController::class, 'edit'])->name('edit');//->middleware('can:usuarios.edit');

    Route::put('/update', [CategoriaController::class, 'update'])->name('update');//->middleware('can:usuarios.edit');

    Route::delete('/delete', [CategoriaController::class, 'destroy'])->name('destroy');//->middleware('can:usuarios.delete');
    
});