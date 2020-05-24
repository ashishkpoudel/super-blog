<?php

use Illuminate\Support\Facades\Route;

Route::post('login', \src\Users\Http\Controllers\UserLoginController::class);

