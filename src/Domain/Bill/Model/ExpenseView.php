<?php

namespace App\Domain\Bill\Model;

use App\Domain\Money\Model\Money;
use App\Domain\Shared\ViewObject;

class ExpenseView implements ViewObject
{
    private Expense $object;

    public function __construct(Expense $object)
    {
        $this->object = $object;
    }

    public function getCost(): Money
    {
        return $this->object->getCost();
    }
}
