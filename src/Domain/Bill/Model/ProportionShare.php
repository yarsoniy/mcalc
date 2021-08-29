<?php

namespace App\Domain\Bill\Model;

class ProportionShare extends Share
{
    private int $units;

    public function __construct(int $units)
    {
        $this->units = $units;
    }

    public function getUnits(): int
    {
        return $this->units;
    }
}
