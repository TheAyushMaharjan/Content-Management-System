<?php

use App\Http\Controllers\admin\pages\Gallery\GalleryCategoryController;
use App\Http\Controllers\admin\pages\Gallery\GallerySetupController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('galleryCategory')->name('galleryCategory.')->group(function () {
        Route::get('/galleryCategory', [GalleryCategoryController::class, 'galleryCategory'])->name('galleryCategory'); // Manage Users
        Route::post('/store', [GalleryCategoryController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [GalleryCategoryController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [GalleryCategoryController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [GalleryCategoryController::class, 'edit'])->name('edit');
    });
    Route::prefix('gallerySetup')->name('gallerySetup.')->group(function () {

    Route::get('/gallerySetup', [GallerySetupController::class, 'gallerySetup'])->name('gallerySetup'); // Manage Users
    Route::post('/store', [GallerySetupController::class, 'store'])->name('store');
    Route::delete('/destroy/{id}', [GallerySetupController::class, 'destroy'])->name('destroy');
    Route::put('/update/{id}', [GallerySetupController::class, 'update'])->name('update');
    Route::get('/edit/{id}', [GallerySetupController::class, 'edit'])->name('edit');
});

});
