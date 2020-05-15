<?php

namespace src\Posts\Queries;

use src\Posts\ValueObjects\PostId;

class GetPost
{
    public PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }
}
