<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\pages\User\RoleController;
use App\Http\Controllers\admin\pages\User\UserController;
use App\Http\Controllers\admin\pages\User\PermissionController;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/manageUser', [UserController::class, 'manageUser'])->name('manageUser'); // Manage Users
        // Route::get('/managePermission', [UserController::class, 'managePermission'])->name('managePermission'); // Manage Permissions
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');

        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions'); // Manage Users
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::post('/permissions/{id}/update', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/{id}/delete', [PermissionController::class, 'destroy'])->name('permissions.delete');
    
        Route::get('/roles', [RoleController::class, 'index'])->name('roles');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/roles/{id}/update', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{id}/delete', [RoleController::class, 'destroy'])->name('roles.delete');

         // User Route
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.delete');

    });
});
