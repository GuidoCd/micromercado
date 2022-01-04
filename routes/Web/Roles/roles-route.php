<?php

use App\Http\Controllers\Role\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->name('roles.')->middleware(['auth'])->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index')->middleware('can:roles.index');
    Route::get('/create', [RoleController::class, 'create'])->name('create')->middleware('can:roles.create');
    Route::post('/store', [RoleController::class, 'store'])->name('store')->middleware('can:roles.create');
    Route::get('/show/{role}', [RoleController::class, 'show'])->name('show')->middleware('can:roles.show');
    Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('edit')->middleware('can:roles.edit');
    Route::put('/update/{role}', [RoleController::class, 'update'])->name('update')->middleware('can:roles.edit');
    Route::delete('/delete', [RoleController::class, 'destroy'])->name('destroy')->middleware('can:roles.delete');
});