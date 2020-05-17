<?php

namespace src\Posts\Http\Handlers;

use Illuminate\Http\Request;
use src\Core\Handlers\BaseHandler;
use src\Core\Http\Response\OkResponse;
use src\Core\Support\QueryOptions;
use src\Posts\Http\Resources\PostResource;
use src\Posts\Queries\GetPaginatedPost;

final class GetPostsHandler extends BaseHandler
{
    public function __invoke(Request $request)
    {
        $posts = $this->queryBus()->query(new GetPaginatedPost(QueryOptions::fromRequest($request)));

        return new OkResponse(
            PostResource::collection($posts)
        );
    }
}
