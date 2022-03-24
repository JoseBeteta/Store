<?php
declare(strict_types=1);

namespace App\Store\Shared\Domain;

final class StoredEvent implements DomainEvent
{
    private $resourceId;
    private $eventId;
    private $eventBody;
    private $occurredOn;
    private $typeName;

    public function __construct(
        string $typeName,
        \DateTimeImmutable $anOccurredOn,
        string $anEventBody,
        string $resourceId
    ) {
        $this->resourceId = $resourceId;
        $this->eventBody = $anEventBody;
        $this->typeName = $typeName;
        $this->occurredOn = $anOccurredOn;
    }

    public function eventBody() : string
    {
        return $this->eventBody;
    }

    public function eventId() : string
    {
        return $this->eventId;
    }

    public function typeName() : string
    {
        return $this->typeName;
    }

    public function occurredOn() : \DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function resourceId(): string
    {
        return $this->resourceId;
    }
}