<?php

namespace src\Posts\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const TABLE = 'posts';

    public $table = self::TABLE;

    protected $casts = [
        'id' => 'string'
    ];
}
