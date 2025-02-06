<?php

use App\Http\Controllers\admin\pages\Blog\BlogCategoryController;
use App\Http\Controllers\admin\pages\Blog\BlogSetupController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/blogCategory', [BlogCategoryController::class, 'blogCategory'])->name('blogCategory'); // Manage Users
        Route::post('/store', [BlogCategoryController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [BlogCategoryController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [BlogCategoryController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [BlogCategoryController::class, 'edit'])->name('edit');

    
    });
    Route::prefix('blogSetup')->name('blogSetup.')->group(function () {
    Route::get('/blogSetup', [BlogSetupController::class, 'blogSetup'])->name('blogSetup'); // Manage Users
    Route::post('/store', [BlogSetupController::class, 'store'])->name('store');
    Route::delete('/destroy/{id}', [BlogSetupController::class, 'destroy'])->name('destroy');
    Route::put('/update/{id}', [BlogSetupController::class, 'update'])->name('update');
    Route::get('/edit/{id}', [BlogSetupController::class, 'edit'])->name('edit');
});

});
