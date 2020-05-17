<?php

namespace src\Users\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const TABLE = 'users';

    public $table = self::TABLE;

    protected $casts = [
        'id' => 'string'
    ];
}
