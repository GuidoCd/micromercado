<?php


use App\Http\Controllers\Personas\PersonasController;



Route::prefix('personas')->name('personas.')->middleware(['auth'])->group(function(){
    Route::get('/',[PersonasController::class,'index'])->name('index')->middleware('can:personas.index');
    Route::get('/create', [PersonasController::class,'create'])->name('create')->middleware('can:personas.create');
    Route::post('/store',[PersonasController::class,'store'])->name('store')->middleware('can:personas.create');
    Route::get('/show/{persona}',[PersonasController::class,'show'])->name('show')->middleware('can:personas.show');
    Route::get('/edit/{persona}',[PersonasController::class,'edit'])->name('edit')->middleware('can:personas.edit');
    Route::delete('/delete',[PersonasController::class,'destroy'])->name('destroy')->middleware('can:personas.destroy');
    Route::put('/update/{persona}', [PersonasController::class, 'update'])->name('update')->middleware('can:personas.edit');
});