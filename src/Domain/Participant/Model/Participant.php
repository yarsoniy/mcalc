<?php

namespace App\Domain\Participant\Model;

class Participant
{
    private ParticipantId $id;

    private string $name;

    public function __construct(ParticipantId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ParticipantId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
