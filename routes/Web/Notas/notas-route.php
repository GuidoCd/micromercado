<?php
use App\Http\Controllers\Nota\NotaController;
use Illuminate\Support\Facades\Route;



Route::prefix('notas')->name('notas.')->middleware(['auth'])->group(function(){


    Route::get('/',[NotaController::class,'index'])->name('index');

    Route::get('/create',[NotaController::class,'create'])->name('create');

    Route::get('/edit/{baja}',[NotaController::class,'update'])->name('edit');

    Route::get('/show/{baja}',[NotaController::class,'show'])->name('show');

    Route::put('/update',[NotaController::class,'update'])->name('update');

    Route::post('/store',[NotaController::class,'store'])->name('store');

    Route::delete('/delete',[NotaController::class,'destroy'])->name('destroy');


});

