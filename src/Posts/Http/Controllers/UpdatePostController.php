<?php

namespace src\Posts\Http\Controllers;

use src\Core\Http\Controllers\BaseController;
use src\Core\Http\Response\UpdatedResponse;
use src\Posts\Commands\UpdatePost;
use src\Posts\Http\Requests\PostRequest;
use src\Posts\Http\Resources\PostResource;
use src\Posts\Queries\GetPost;
use src\Posts\ValueObjects\PostId;

final class UpdatePostController extends BaseController
{
    public function __invoke(string $postId, PostRequest $request)
    {
        $postId = PostId::fromString($postId);
        $this->commandBus()->execute(
            app(UpdatePost::class, [
                'postId' => $postId,
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ])
        );

        $post = $this->queryBus()->query(new GetPost($postId));

        return new UpdatedResponse(
            PostResource::make($post)
        );
    }
}
