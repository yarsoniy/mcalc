<?php

namespace App\Domain\Bill\Exception;

use App\Domain\Bill\Model\BillId;

class UnknownExpenseException extends \Exception
{
    public static function withId(BillId $billId, string $expenseId)
    {
        $msg = "Bill {$billId->id()} doesn't have an expense with id {$expenseId}";

        return new self($msg);
    }
}
