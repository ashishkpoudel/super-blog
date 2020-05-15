<?php

namespace src\Users\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const TABLE = 'users';

    public $table = self::TABLE;

    protected $casts = [
        'id' => 'string'
    ];
}
