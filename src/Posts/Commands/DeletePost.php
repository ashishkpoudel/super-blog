<?php

namespace src\Posts\Commands;

use src\Core\MessageBus\Interfaces\CommandInterface;
use src\Posts\ValueObjects\PostId;

class DeletePost implements CommandInterface
{
    public PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }
}
