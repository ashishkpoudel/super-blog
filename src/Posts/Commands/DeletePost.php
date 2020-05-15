<?php

namespace src\Posts\Commands;

use src\Posts\ValueObjects\PostId;

class DeletePost
{
    public PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }
}
