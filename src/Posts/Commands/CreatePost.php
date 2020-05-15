<?php

namespace src\Posts\Commands;

use src\Core\MessageBus\Interfaces\CommandInterface;
use src\Posts\ValueObjects\PostId;
use src\Users\ValueObjects\UserId;

class CreatePost implements CommandInterface
{
    public PostId $postId;
    public UserId $userId;
    public string $title;
    public string $body;

    public function __construct(PostId $postId, UserId $userId, string $title, string $body)
    {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->title = $title;
        $this->body = $body;
    }
}
