<?php

namespace App\Domain\Money\Model;

use App\Domain\Shared\ValueObject;

/**
 * TODO: refactor to use int base.
 */
class Money implements ValueObject
{
    private float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function add(Money $money): Money
    {
        return new self($this->value + $money->value);
    }

    public function sub(Money $money): Money
    {
        return new self($this->value - $money->value);
    }
}
