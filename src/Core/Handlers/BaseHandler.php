<?php

namespace src\Core\Handlers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use src\Core\Bus\Command\CommandBus;
use src\Core\Bus\Query\QueryBus;
use src\Core\Bus\Event\EventBus;

abstract class BaseHandler extends Controller
{
    use AuthorizesRequests;

    public function commandBus(): CommandBus
    {
        return app(CommandBus::class);
    }

    public function eventBus(): EventBus
    {
        return app(EventBus::class);
    }

    public function queryBus(): QueryBus
    {
        return app(QueryBus::class);
    }
}
