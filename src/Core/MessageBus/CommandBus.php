<?php

namespace src\Core\MessageBus;

use Illuminate\Bus\Dispatcher;

class CommandBus
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param $command
     * @return mixed
     */
    public function execute($command)
    {
        return $this->dispatcher->dispatch($command);
    }
}
