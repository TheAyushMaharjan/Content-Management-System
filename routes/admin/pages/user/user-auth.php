<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\pages\User\UserController;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/manageUser', [UserController::class, 'manageUser'])->name('manageUser'); // Manage Users
        // Route::get('/managePermission', [UserController::class, 'managePermission'])->name('managePermission'); // Manage Permissions
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');


    });
});
