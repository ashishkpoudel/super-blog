<?php

namespace src\Users\Services;

use Illuminate\Hashing\HashManager;
use src\Users\Models\User;

class AuthService
{
    private HashManager $hash;

    public function __construct(HashManager $hash)
    {
        $this->hash = $hash;
    }

    public function tryLogin(string $emailAddress, string $password): bool
    {
        $user = User::query()->where('emailAddress', '=', $emailAddress)->first();
        if ($user) {
            return $this->hash->check(
                $password,
                $user->password
            );
        }

        return false;
    }
}
