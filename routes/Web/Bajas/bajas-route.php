<?php
use App\Http\Controllers\Baja\BajaController;
use Illuminate\Support\Facades\Route;



Route::prefix('bajas')->name('bajas.')->middleware(['auth'])->group(function(){


    Route::get('/',[BajaController::class,'index'])->name('index');

    Route::get('/create',[BajaController::class,'create'])->name('create');

    Route::get('/edit/{baja}',[BajaController::class,'update'])->name('edit');

    Route::get('/show/{baja}',[BajaController::class,'show'])->name('show');

    Route::put('/update',[BajaController::class,'update'])->name('update');

    Route::post('/store',[BajaController::class,'store'])->name('store');

    Route::delete('/delete',[BajaController::class,'destroy'])->name('destroy');


});

