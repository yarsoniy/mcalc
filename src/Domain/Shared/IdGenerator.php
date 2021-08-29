<?php

namespace App\Domain\Shared;

interface IdGenerator
{
    public function generate(): string;
}
