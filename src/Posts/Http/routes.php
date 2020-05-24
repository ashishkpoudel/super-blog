<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('posts', src\Posts\Http\Controllers\GetPostsController::class);
    Route::post('posts', src\Posts\Http\Controllers\CreatePostController::class);
    Route::patch('posts/{post}', src\Posts\Http\Controllers\DeletePostController::class);
    Route::delete('posts/{post}', src\Posts\Http\Controllers\DeletePostController::class);
});
