<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Editor\pages\Gallery\GallerySetupController;
use App\Http\Controllers\Editor\pages\Gallery\GalleryCategoryController;

Route::middleware('auth:editor')->prefix('editor')->name('editor.')->group(function () {
    Route::prefix('galleryCategory')->name('galleryCategory.')->group(function () {
        Route::get('/index', [GalleryCategoryController::class, 'index'])->name('index'); // Manage Users
        Route::post('/store', [GalleryCategoryController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [GalleryCategoryController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [GalleryCategoryController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [GalleryCategoryController::class, 'edit'])->name('edit');
    });
    Route::prefix('gallerySetup')->name('gallerySetup.')->group(function () {
    Route::get('/index', [GallerySetupController::class, 'index'])->name('index'); // Manage Users
    Route::post('/store', [GallerySetupController::class, 'store'])->name('store');
    Route::delete('/destroy/{id}', [GallerySetupController::class, 'destroy'])->name('destroy');
    Route::put('/update/{id}', [GallerySetupController::class, 'update'])->name('update');
    Route::get('/edit/{id}', [GallerySetupController::class, 'edit'])->name('edit');
});

});
