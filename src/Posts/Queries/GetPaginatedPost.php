<?php

namespace src\Posts\Queries;

use src\Core\Support\QueryOptions;

class GetPaginatedPost
{
    public QueryOptions $query;

    public function __construct(QueryOptions $queryOptions)
    {
        $this->query = $queryOptions;
    }
}
