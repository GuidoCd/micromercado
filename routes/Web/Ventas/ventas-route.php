<?php

use App\Http\Controllers\Venta\VentaController;
use Illuminate\Support\facades\Route;


Route::prefix('ventas')->name('ventas.')->middleware(['auth'])->group(function(){


    Route::get('/',[VentaController::class,'index'])->name('index');

    Route::get('/edit/{venta}',[VentaController::class,'edit'])->name('edit');

    Route::get('/show/{venta}',[VentaController::class,'show'])->name('show');

    Route::get('/create',[VentaController::class,'create'])->name('create');

    Route::put('/update/{venta}',[VentaController::class,'update'])->name('update');

    Route::post('/store',[VentaController::class,'store'])->name('store');

    Route::delete('delete',[VentaController::class,'destroy'])->name('destroy');




});