<?php

namespace src\Posts\Http\Controllers;

use src\Core\Http\Controllers\BaseController;
use src\Core\Http\Response\DeletedResponse;
use src\Posts\Commands\DeletePost;
use src\Posts\ValueObjects\PostId;

final class DeletePostController extends BaseController
{
    public function __invoke(string $postId)
    {
        $this->commandBus()->execute(new DeletePost(PostId::fromString($postId)));
        return new DeletedResponse();
    }
}
