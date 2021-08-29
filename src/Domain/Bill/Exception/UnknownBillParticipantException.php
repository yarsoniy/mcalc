<?php

namespace App\Domain\Bill\Exception;

use App\Domain\Bill\Model\BillId;
use App\Domain\Participant\Model\ParticipantId;

class UnknownBillParticipantException extends \Exception
{
    public static function withId(BillId $billId, ParticipantId $participantId)
    {
        $msg = "Bill {$billId->id()} doesn't have a participant with id {$participantId->id()}";

        return new self($msg);
    }
}
