<?php

namespace App\Domain\Bill\Model;

use App\Domain\Money\Model\Money;

class MoneyShare extends Share
{
    private Money $value;

    public function __construct(Money $value)
    {
        $this->value = $value;
    }

    public function getValue(): Money
    {
        return $this->value;
    }
}
