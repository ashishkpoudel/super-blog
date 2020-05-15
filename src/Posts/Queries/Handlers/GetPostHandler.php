<?php

namespace src\Posts\Queries\Handlers;

use src\Posts\Models\Post;
use src\Posts\Queries\GetPost;

class GetPostHandler
{
    public function handle(GetPost $query): Post
    {
        return Post::query()->findOrFail($query->postId->getValue())->first();
    }
}
