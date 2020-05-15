<?php

namespace src\Posts\Commands;

use src\Posts\ValueObjects\PostId;

class UpdatePost
{
    public PostId $postId;
    public ?string $title;
    public ?string $body;

    public function __construct(PostId $postId, ?string $title, ?string $body)
    {
        $this->postId = $postId;
        $this->title = $title;
        $this->body = $body;
    }
}
