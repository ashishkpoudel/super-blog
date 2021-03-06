<?php

namespace src\Posts\Commands;

use src\Posts\ValueObjects\PostId;
use src\Users\ValueObjects\UserId;
use src\Core\Bus\Command\CommandInterface;

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
