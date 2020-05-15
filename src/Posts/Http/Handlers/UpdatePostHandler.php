<?php

namespace src\Posts\Http\Handlers;

use src\Core\Handlers\BaseHandler;
use src\Core\Http\Response\EmptyResponse;
use src\Posts\Commands\UpdatePost;
use src\Posts\Http\Requests\PostRequest;
use src\Posts\ValueObjects\PostId;

final class UpdatePostHandler extends BaseHandler
{
    public function __invoke(string $postId, PostRequest $request)
    {
        dispatch_now(app(UpdatePost::class, [
            'postId' => PostId::fromString($postId),
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ]));

        return new EmptyResponse(201);
    }
}
