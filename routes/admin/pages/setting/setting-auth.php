<?php

use App\Http\Controllers\admin\pages\Setting\HeaderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('/header', [HeaderController::class, 'header'])->name('header'); // Manage Users
        Route::post('/store', [HeaderController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [HeaderController::class, 'destroy'])->name('destroy');
        // Route::put('/update/{id}', [HeaderController::class, 'update'])->name('update');
        // Route::get('/edit/{id}', [HeaderController::class, 'edit'])->name('edit');
    });
 
});
