<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\pages\User\UserController;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/blogCategory', [UserController::class, 'blogCategory'])->name('blogCategory'); // Manage Users
      


    });
});
