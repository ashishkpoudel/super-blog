<?php

namespace src\Core\ValueObjects;

use Symfony\Component\Uid\Uuid;

class Identity
{
    private string $id;

    private function __construct(string $id)
    {
        if (!Uuid::isValid($id)) {
            throw new \InvalidArgumentException(
                'Invalid identity provided'
            );
        }

        $this->id = $id;
    }

    final public function getValue(): string
    {
        return $this->id;
    }

    final public static function new()
    {
        return new static(Uuid::v4());
    }

    final public static function fromString(string $id)
    {
        return new static($id);
    }
}
