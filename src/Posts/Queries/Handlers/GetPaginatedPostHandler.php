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

        if (isset($query->query->filters['title'])) {
            $postQuery->where('title', 'like', '%' . $query->query->filters['title'] . '%');
        }

        if (isset($query->query->filters['slug'])) {
            $postQuery->where('slug', 'like', '%' . $query->query->filters['slug'] . '%');
        }

        return $postQuery->limit($query->query->limit)->paginate($query->query->page);
    }
}
