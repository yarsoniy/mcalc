<?php

namespace App\Domain\Shared;

abstract class Identity implements ValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function id(): string
    {
        return $this->value;
    }
}
