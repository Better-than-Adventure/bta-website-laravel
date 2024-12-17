<?php

use App\Http\Controllers\Api\ApiSoundController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTypeController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('sounds', [ApiSoundController::class, 'getSounds']);
Route::get('sounds/refresh', [ApiSoundController::class, 'refreshSounds']);


Route::prefix('/{postType}')->group(function () {
    Route::get('/', [PostTypeController::class, 'list'])->name('posts.list');
    Route::prefix('{post}')->group(function () {
        Route::get('/', [PostController::class, 'view'])->name('posts.view');
    });
});
