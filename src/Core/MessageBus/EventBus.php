<?php

namespace src\Core\MessageBus;

use Illuminate\Events\Dispatcher;

class EventBus
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param $event
     * @return mixed
     */
    public function publish($event)
    {
        return $this->dispatcher->dispatch($event);
    }
}
