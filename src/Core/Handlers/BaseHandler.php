<?php

namespace src\Core\Handlers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use src\Core\MessageBus\CommandBus;
use src\Core\MessageBus\EventBus;
use src\Core\MessageBus\QueryBus;

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
