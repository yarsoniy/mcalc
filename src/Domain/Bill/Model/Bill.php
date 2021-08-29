<?php

namespace App\Domain\Bill\Model;

use App\Domain\Bill\Exception\UnknownBillParticipantException;
use App\Domain\Bill\Exception\UnknownExpenseException;
use App\Domain\Money\Model\Money;
use App\Domain\Participant\Model\ParticipantId;
use App\Domain\Shared\AggregateRoot;
use App\Domain\Shared\IdGenerator;

class Bill implements AggregateRoot
{
    private BillId $id;

    /** @var array<string, BillParticipant> */
    private array $billParticipants;

    /** @var array<string, Expense> */
    private array $expenses;

    private function getOrFailBillParticipant(ParticipantId $participantId): BillParticipant
    {
        $billParticipant = $this->billParticipants[$participantId->id()] ?? null;
        if (!$billParticipant) {
            throw UnknownBillParticipantException::withId($this->id, $participantId);
        }

        return $billParticipant;
    }

    private function getOrFailExpense(string $expenseId): Expense
    {
        $expense = $this->expenses[$expenseId] ?? null;
        if (!$expense) {
            throw UnknownExpenseException::withId($this->id, $expenseId);
        }

        return $expense;
    }

    /**
     * @return array<int, ParticipantId>
     */
    public function getParticipantIds(): array
    {
        $result = [];
        foreach ($this->billParticipants as $billParticipant) {
            $result[] = $billParticipant->getParticipantId();
        }

        return $result;
    }

    public function setBillParticipantPaidAmount(ParticipantId $participantId, Money $paidAmount)
    {
        $billParticipant = $this->getOrFailBillParticipant($participantId);
        $billParticipant->setPaidAmount($paidAmount);
    }

    public function addExpense(IdGenerator $idGenerator, string $name, Money $cost): void
    {
        $expenseId = $idGenerator->generate();
        $this->expenses[$expenseId] = new Expense($this, $expenseId, $name, $cost, []);
    }

    public function getExpense(string $expenseId): ExpenseView
    {
        return new ExpenseView($this->getOrFailExpense($expenseId));
    }

    /**
     * @return array<string, ExpenseView>
     */
    public function getExpenses(): array
    {
        $result = [];
        foreach ($this->expenses as $expense) {
            $result[$expense->getId()] = new ExpenseView($expense);
        }

        return $result;
    }

    public function getTotal(): Money
    {
        $total = new Money(0);
        foreach ($this->expenses as $expense) {
            $total = $total->add($expense->getCost());
        }

        return $total;
    }
}
