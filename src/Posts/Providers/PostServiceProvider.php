<?php

namespace src\Posts\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use src\Posts\Commands\CreatePost;
use src\Posts\Commands\DeletePost;
use src\Posts\Commands\Handlers\CreatePostHandler;
use src\Posts\Commands\Handlers\DeletePostHandler;
use src\Posts\Commands\Handlers\UpdatePostHandler;
use src\Posts\Commands\UpdatePost;
use src\Posts\Queries\GetPaginatedPost;
use src\Posts\Queries\GetPost;
use src\Posts\Queries\Handlers\GetPaginatedPostHandler;
use src\Posts\Queries\Handlers\GetPostHandler;

class PostServiceProvider extends ServiceProvider
{
    private array $commands = [
        CreatePost::class => CreatePostHandler::class,
        UpdatePost::class => UpdatePostHandler::class,
        DeletePost::class => DeletePostHandler::class
    ];

    private array $queries = [
        GetPaginatedPost::class => GetPaginatedPostHandler::class,
        GetPost::class => GetPostHandler::class
    ];

    public function boot()
    {
        Bus::map($this->commands);
        Bus::map($this->queries);

        Route::prefix('api')->middleware('api')->group(base_path('src/Posts/Http/routes.php'));
    }
}
