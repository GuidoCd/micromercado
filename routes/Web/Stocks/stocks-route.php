<?php
use App\Http\Controllers\Stock\StockController;
use Illuminate\Support\Facades\Route;

Route::prefix('stocks')->name('stocks.')->middleware(['auth'])->group(function(){
    Route::get('/',[StockController::class,'index'])->name('index')->middleware('can:stocks.index');
    Route::get('/search',[StockController::class,'search'])->name('search')->middleware('can:stocks.index');
    Route::get('/excel/{producto_id}/{fecha_vencimiento}/{con_stock}',[StockController::class,'excel'])->name('excel')->middleware('can:stocks.excel');
});

