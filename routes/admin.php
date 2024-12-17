<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTypeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::prefix('posts')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('admin.posts');
            Route::get('/create', [PostController::class, 'create'])->name('admin.posts.create');
            Route::post('/store', [PostController::class, 'store'])->name('admin.posts.store');
            Route::get('/edit/{post}', [PostController::class, 'edit'])->name('admin.posts.edit');
            Route::post('/update/{post}', [PostController::class, 'update'])->name('admin.posts.update');
        });
        Route::prefix('post_type')->group(function () {
            Route::get('/', [PostTypeController::class, 'index'])->name('admin.postTypes');
            Route::get('/create', [PostTypeController::class, 'create'])->name('admin.postTypes.create');
            Route::post('/store', [PostTypeController::class, 'store'])->name('admin.postTypes.store');
            Route::get('/edit/{postTypeId}', [PostTypeController::class, 'edit'])->name('admin.postTypes.edit');
            Route::post('/update/{postTypeId}', [PostTypeController::class, 'update'])->name('admin.postTypes.update');
        });
    });
});
