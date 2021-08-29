<?php

namespace App\Domain\Bill\Model;

use App\Domain\Money\Model\Money;
use App\Domain\Participant\Model\ParticipantId;
use App\Domain\Shared\Entity;

class Expense implements Entity
{
    private Bill $bill;

    private string $id;

    private string $name;

    private Money $cost;

    /** @var array<string, Share> */
    private array $participantShares;

    public function __construct(Bill $bill, string $id, string $name, Money $cost, array $participantShares)
    {
        $this->bill = $bill;
        $this->id = $id;
        $this->name = $name;
        $this->cost = $cost;
        $this->participantShares = $participantShares;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCost(): Money
    {
        return $this->cost;
    }

    public function setParticipantShare(ParticipantId $participantId, Share $share)
    {
        $this->participantShares[$participantId->id()] = $share;
    }

    private function getParticipantShare(ParticipantId $participantId): Share
    {
        return $this->participantShares[$participantId->id()] ?? new ProportionShare(1);
    }

    /**
     * @return array<string, MoneyShare>
     */
    public function calculateResultMoneyShares(): array
    {
        $participantIds = $this->bill->getParticipantIds();
        $costToShare = $this->cost;
        $finalMoneyShares = [];

        $initialProportionShares = [];
        $totalProportionUnits = 0;

        foreach ($participantIds as $participantId) {
            $share = $this->getParticipantShare($participantId);
            if ($share instanceof MoneyShare) {
                $finalMoneyShares[$participantId->id()] = $share;
                $costToShare = $costToShare->sub($share->getValue());
            } elseif ($share instanceof ProportionShare) {
                $initialProportionShares[$participantId->id()] = $share;
                $totalProportionUnits += $share->getUnits();
            }
        }

        foreach ($initialProportionShares as $key => $proportionShare) {
            $moneyValue = $costToShare * $proportionShare->getUnits() / $totalProportionUnits;
            $finalMoneyShares[$key] = new MoneyShare(new Money($moneyValue));
        }

        //sort by participants order in bill
        $result = [];
        foreach ($participantIds as $participantId) {
            $key = $participantId->id();
            $result[$key] = $finalMoneyShares[$key];
        }

        return $result;
    }
}
