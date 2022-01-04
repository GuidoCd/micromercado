<?php

use App\Http\Controllers\Categoria\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::prefix('categorias')->name('categorias.')->middleware(['auth'])->group(function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('index')->middleware('can:categorias.index');
    Route::get('/create', [CategoriaController::class, 'create'])->name('create')->middleware('can:categorias.create');
    Route::post('/store', [CategoriaController::class, 'store'])->name('store')->middleware('can:categorias.create');
    Route::get('/show/{categoria}', [CategoriaController::class, 'show'])->name('show')->middleware('can:categorias.show');
    Route::get('/edit/{categoria}', [CategoriaController::class, 'edit'])->name('edit')->middleware('can:categorias.edit');
    Route::put('/update', [CategoriaController::class, 'update'])->name('update')->middleware('can:categorias.edit');
    Route::delete('/delete', [CategoriaController::class, 'destroy'])->name('destroy')->middleware('can:categorias.delete');
});