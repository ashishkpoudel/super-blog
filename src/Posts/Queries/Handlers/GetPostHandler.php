<?php

namespace src\Posts\Queries\Handlers;

use Illuminate\Cache\CacheManager;
use src\Posts\Models\Post;
use src\Posts\Queries\GetPost;

class GetPostHandler
{
    private CacheManager $cache;

    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    public function handle(GetPost $query): Post
    {
        return Post::query()->findOrFail($query->postId->getValue())->first();
    }
}
