<?php

namespace src\Core\MessageBus;

use Illuminate\Bus\Dispatcher;
use src\Core\MessageBus\Interfaces\QueryInterface;

class QueryBus
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param QueryInterface $query
     * @return mixed
     */
    public function query(QueryInterface $query)
    {
        return $this->dispatcher->dispatch($query);
    }
}
