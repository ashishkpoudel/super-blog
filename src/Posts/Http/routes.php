<?php

use Illuminate\Support\Facades\Route;
Route::get('posts', src\Posts\Http\Handlers\GetPostsHandler::class);
Route::middleware('auth:api')->group(function() {

    Route::post('posts', src\Posts\Http\Handlers\CreatePostHandler::class);
    Route::patch('posts/{post}', src\Posts\Http\Handlers\DeletePostHandler::class);
    Route::delete('posts/{post}', src\Posts\Http\Handlers\DeletePostHandler::class);
});
