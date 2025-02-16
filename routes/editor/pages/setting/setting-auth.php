<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Editor\pages\Setting\HeaderController;

Route::middleware('auth:editor')->prefix('editor')->name('editor.')->group(function () {
    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('/index', [HeaderController::class, 'index'])->name('index'); // Manage Users
        Route::post('/store', [HeaderController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [HeaderController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [HeaderController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [HeaderController::class, 'edit'])->name('edit');
    });
 
});
