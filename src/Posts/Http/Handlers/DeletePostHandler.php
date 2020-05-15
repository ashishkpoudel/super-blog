<?php

namespace src\Posts\Http\Handlers;

use src\Core\Handlers\BaseHandler;
use src\Core\Http\Response\EmptyResponse;
use src\Posts\Commands\DeletePost;
use src\Posts\ValueObjects\PostId;

final class DeletePostHandler extends BaseHandler
{
    public function __invoke(string $postId)
    {
        $this->commandBus()->execute(new DeletePost(PostId::fromString($postId)));
        return new EmptyResponse(204);
    }
}
