<?php

namespace src\Users\Queries\Handlers;

use src\Users\Models\User;
use src\Users\Queries\GetUserAuthTokenByEmail;

class GetUserAuthTokenByEmailHandler
{
    public function handle(GetUserAuthTokenByEmail $query): array
    {
        $user = User::query()->where('emailAddress', '=', $query->emailAddress)->first();
        return [
            'token' => $user->createToken('auth-token')->plainTextToken,
            'type' => 'Bearer'
        ];
    }
}
