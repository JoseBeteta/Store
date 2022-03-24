<?php
declare(strict_types=1);

namespace App\Store\Shared\Domain;

interface DomainEvent
{
    public function occurredOn() : \DateTimeImmutable;
    public function resourceId() : string;
}