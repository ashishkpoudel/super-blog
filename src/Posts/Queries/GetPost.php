<?php

namespace src\Posts\Queries;

use src\Core\MessageBus\Interfaces\QueryInterface;
use src\Posts\ValueObjects\PostId;

class GetPost implements QueryInterface
{
    public PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }
}
