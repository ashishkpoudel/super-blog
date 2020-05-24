<?php

namespace src\Posts\Http\Controllers;

use Illuminate\Http\Request;
use src\Core\Http\Controllers\BaseController;
use src\Core\Http\Response\OkResponse;
use src\Core\Support\QueryOptions;
use src\Posts\Http\Resources\PostResource;
use src\Posts\Queries\GetPaginatedPost;

final class GetPostsController extends BaseController
{
    public function __invoke(Request $request)
    {
        $posts = $this->queryBus()->query(new GetPaginatedPost(QueryOptions::fromRequest($request)));

        return new OkResponse(
            PostResource::collection($posts)
        );
    }
}
