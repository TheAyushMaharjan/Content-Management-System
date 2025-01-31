<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Editor\ProfileController;
use App\Http\Controllers\Editor\Auth\RegisteredUserController;
use App\Http\Controllers\Editor\Auth\AuthenticatedSessionController;


Route::middleware('guest:editor')->prefix('editor')->name('editor.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:editor')->prefix('editor')->name('editor.')->group(function () {
    Route::get('/dashboard', function () {
        return view('editor.dashboard');
    })->middleware(['verified'])->name('dashboard');
    
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
