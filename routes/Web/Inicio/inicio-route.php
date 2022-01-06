<?php

use App\Http\Controllers\Inicio\InicioController;
use Illuminate\Support\Facades\Route;

Route::prefix('inicio')->name('inicio.')->middleware(['auth'])->group(function () {
    Route::get('/', [InicioController::class, 'index'])->name('welcome');
    Route::post('/cambiar-pass', [InicioController::class, 'cambiarPassword'])->name('change-password');
});