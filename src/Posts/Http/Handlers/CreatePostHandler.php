<?php

namespace src\Posts\Http\Handlers;

use src\Core\Http\Response\CreatedResponse;
use src\Posts\ValueObjects\PostId;
use src\Core\Handlers\BaseHandler;
use src\Posts\Commands\CreatePost;
use src\Posts\Http\Requests\PostRequest;
use src\Posts\Http\Resources\PostResource;
use src\Posts\Queries\GetPost;
use src\Users\ValueObjects\UserId;

final class CreatePostHandler extends BaseHandler
{
    public function __invoke(PostRequest $request)
    {
        $postId = PostId::new();
        $userId = UserId::fromString($request->user()->id);

        $this->commandBus()->execute(
            app(CreatePost::class, [
                'postId' => $postId,
                'userId' => $userId,
                'title' => $request->input('title'),
                'body' => $request->input('body'),
            ])
        );

        $post = $this->queryBus()->query(new GetPost($postId));

        return new CreatedResponse(
            PostResource::make($post)
        );
    }
}
