<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\pages\Blog\BlogSetupController;
use App\Http\Controllers\admin\pages\Setting\HeaderController;
use App\Http\Controllers\admin\pages\Gallery\GallerySetupController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/blogSetup/frontDisplay', [BlogSetupController::class, 'frontDisplay'])->name('frontDisplay'); // Manage Users
Route::get('/gallerySetup/galleryDisplay', [GallerySetupController::class, 'galleryDisplay'])->name('galleryDisplay'); // Manage Users
Route::get('/setting/headerDisplay', [HeaderController::class, 'headerDisplay'])->name('headerDisplay'); // Manage Users



require __DIR__.'/auth.php';
require __DIR__.'/api.php';

require __DIR__.'/admin/pages/user/user-auth.php';
require __DIR__.'/admin/pages/blog/blog-auth.php';
require __DIR__.'/admin/pages/media/media-auth.php';
require __DIR__.'/admin/pages/setting/setting-auth.php';

require __DIR__.'/admin/admin-auth.php';

require __DIR__.'/editor/editor-auth.php';


