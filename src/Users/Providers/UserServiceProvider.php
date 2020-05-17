<?php

namespace src\Users\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use src\Users\Queries\GetUserAuthTokenByEmail;
use src\Users\Queries\Handlers\GetUserAuthTokenByEmailHandler;

class UserServiceProvider extends ServiceProvider
{
    private array $queries = [
        GetUserAuthTokenByEmail::class => GetUserAuthTokenByEmailHandler::class
    ];

    public function boot()
    {
        Bus::map($this->queries);

        Route::prefix('api')->middleware('api')->group(base_path('src/Users/Http/routes.php'));
    }
}
