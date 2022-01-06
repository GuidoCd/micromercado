<?php
use App\Http\Controllers\Nota\NotaController;
use Illuminate\Support\Facades\Route;

Route::prefix('notas')->name('notas.')->middleware(['auth'])->group(function(){
    Route::get('/',[NotaController::class,'index'])->name('index')->middleware('can:notas.index');
    Route::get('/create',[NotaController::class,'create'])->name('create')->middleware('can:notas.create');
    Route::post('/store',[NotaController::class,'store'])->name('store')->middleware('can:notas.create');
    Route::get('/edit/{baja}',[NotaController::class,'edit'])->name('edit')->middleware('can:notas.edit');
    Route::put('/update',[NotaController::class,'update'])->name('update')->middleware('can:notas.edit');
    Route::get('/show/{baja}',[NotaController::class,'show'])->name('show')->middleware('can:notas.show');
    Route::delete('/delete',[NotaController::class,'destroy'])->name('destroy')->middleware('can:notas.anular');
});

