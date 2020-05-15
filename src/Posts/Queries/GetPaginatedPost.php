<?php

namespace src\Posts\Queries;

use src\Core\MessageBus\Interfaces\QueryInterface;
use src\Core\Support\QueryOptions;

class GetPaginatedPost implements QueryInterface
{
    public QueryOptions $query;

    public function __construct(QueryOptions $queryOptions)
    {
        $this->query = $queryOptions;
    }
}
