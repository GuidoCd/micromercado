<?php
use App\Http\Controllers\Nota\NotaController;
use Illuminate\Support\Facades\Route;

Route::prefix('notas')->name('notas.')->middleware(['auth'])->group(function(){
    Route::get('/',[NotaController::class,'index'])->name('index')->middleware('can:notas.index');
    Route::get('/search',[NotaController::class,'search'])->name('search')->middleware('can:notas.index');
    Route::get('/excel/{tipo_movimiento}/{codigo}/{estado}',[NotaController::class,'excel'])->name('excel')->middleware('can:notas.excel');
    Route::get('/create',[NotaController::class,'create'])->name('create')->middleware('can:notas.create');
    Route::post('/store',[NotaController::class,'store'])->name('store')->middleware('can:notas.create');
    Route::get('/edit/{nota}',[NotaController::class,'edit'])->name('edit')->middleware('can:notas.edit');
    Route::put('/update',[NotaController::class,'update'])->name('update')->middleware('can:notas.edit');
    Route::get('/show/{nota}',[NotaController::class,'show'])->name('show')->middleware('can:notas.show');
    Route::get('/anular/{nota}',[NotaController::class,'anular'])->name('anular')->middleware('can:notas.anular');
    Route::get('/concluir/{nota}',[NotaController::class,'concluir'])->name('concluir')->middleware('can:notas.concluir');
});

