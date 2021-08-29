<?php

namespace App\Domain\Bill\Model;

use App\Domain\Money\Model\Money;
use App\Domain\Participant\Model\ParticipantId;
use App\Domain\Shared\Entity;

class BillParticipant implements Entity
{
    private Bill $bill;

    private ParticipantId $participantId;

    private Money $paidAmount;

    public function __construct(Bill $bill, ParticipantId $participantId, Money $paidAmount)
    {
        $this->bill = $bill;
        $this->participantId = $participantId;
        $this->paidAmount = $paidAmount;
    }

    public function getParticipantId(): ParticipantId
    {
        return $this->participantId;
    }

    public function setPaidAmount(Money $paidAmount): void
    {
        $this->paidAmount = $paidAmount;
    }
}
