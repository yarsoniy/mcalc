<?php

namespace App\Domain\Bill\Service;

use App\Domain\Bill\Model\BillId;

interface BillRepository
{
    public function nextId(): BillId;
}
