<?php


use App\Http\Controllers\Personas\PersonasController;



Route::prefix('personas')->name('personas.')->middleware(['auth'])->group(function(){

    Route::get('/',[PersonasController::class,'index'])->name('index');
    
    Route::get('/create', [PersonasController::class,'create'])->name('create');

    Route::post('/store',[PersonasController::class,'store'])->name('store');

    Route::get('/show/{persona}',[PersonasController::class,'show'])->name('show');

    Route::get('/edit/{persona}',[PersonasController::class,'edit'])->name('edit');

    Route::delete('/delete',[PersonasController::class,'destroy'])->name('destroy');

    Route::put('/update/{persona}', [PersonasController::class, 'update'])->name('update');

});