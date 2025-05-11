<?php

use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\InfographicController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PostController;
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

        Route::prefix('/posts')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('admin.posts');
            Route::get('create', [PostController::class, 'create'])->name('admin.posts.create');
            Route::post('store', [PostController::class, 'store'])->name('admin.posts.store');
            Route::get('edit/{post}', [PostController::class, 'edit'])->name('admin.posts.edit');
            Route::post('update/{post}', [PostController::class, 'update'])->name('admin.posts.update');
            Route::post('delete/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
            Route::get('media/{post}', [PostController::class, 'media'])->name('admin.posts.media');
            Route::post('media/{post}', [PostController::class, 'storeMedia'])->name('admin.posts.media-upload');
            Route::post('media/{post}/{galleryItem}', [PostController::class, 'deleteMedia'])->name('admin.posts.media-delete');
        });

        Route::group(['middleware' => ['role:admin']], function () {
            Route::prefix('/users')->group(function () {
                Route::get('/', [AdminUserController::class, 'index'])->name('admin.users');
                Route::get('create', [AdminUserController::class, 'create'])->name('admin.users.create');
                Route::post('store', [AdminUserController::class, 'store'])->name('admin.users.store');
                Route::get('edit/{user}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
                Route::post('update/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
                Route::post('delete/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
                Route::post('request-password-change/{user}', [AdminUserController::class, 'requestPasswordChange'])->name('admin.users.request-password-change');
            });
        });

        Route::prefix('/infographics')->group(function () {
            Route::get('/', [InfographicController::class, 'index'])->name('admin.infographics');
            Route::post('/', [InfographicController::class, 'store'])->name('admin.infographics.store');
            Route::post('delete/{item}', [InfographicController::class, 'destroy'])->name('admin.infographics.destroy');
        });

        Route::prefix('navigation')->group(function () {
            Route::get('/', [NavigationController::class, 'index'])->name('admin.navigation');
        });
    });
});
