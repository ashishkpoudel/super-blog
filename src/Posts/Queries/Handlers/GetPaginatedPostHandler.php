<?php

namespace src\Posts\Queries\Handlers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use src\Posts\Models\Post;
use src\Posts\Queries\GetPaginatedPost;

class GetPaginatedPostHandler
{
    public function handle(GetPaginatedPost $query): LengthAwarePaginator
    {
        $postQuery = Post::query();
        $filters = $query->query->filters;

        if (isset($filters['title'])) {
            $postQuery->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['slug'])) {
            $postQuery->where('slug', 'like', '%' . $filters['slug'] . '%');
        }

        return $postQuery->limit($query->query->limit)->paginate($query->query->page);
    }
}
