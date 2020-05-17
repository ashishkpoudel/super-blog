<?php

use Illuminate\Support\Facades\Route;

Route::post('login', \src\Users\Http\Handlers\UserLoginHandler::class);

