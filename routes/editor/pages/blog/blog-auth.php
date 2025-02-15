<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Editor\pages\Blog\BlogSetupController;
use App\Http\Controllers\Editor\pages\Blog\BlogCategoryController;


Route::middleware('auth:editor')->prefix('editor')->name('editor.')->group(function () {
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/index', [BlogCategoryController::class, 'index'])->name('index'); // Manage Users
        Route::post('/store', [BlogCategoryController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [BlogCategoryController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [BlogCategoryController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [BlogCategoryController::class, 'edit'])->name('edit');

    
    });
    Route::prefix('blogSetup')->name('blogSetup.')->group(function () {
    Route::get('/index', [BlogSetupController::class, 'index'])->name('index'); // Manage Users
    Route::post('/store', [BlogSetupController::class, 'store'])->name('store');
    Route::delete('/destroy/{id}', [BlogSetupController::class, 'destroy'])->name('destroy');
    Route::put('/update/{id}', [BlogSetupController::class, 'update'])->name('update');
    Route::get('/edit/{id}', [BlogSetupController::class, 'edit'])->name('edit');
});

});
