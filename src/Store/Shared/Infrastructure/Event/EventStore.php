<?php
declare(strict_types=1);

namespace App\Store\Shared\Infrastructure\Event;

use App\Store\Shared\Domain\DomainEvent;

interface EventStore
{
    public function append(DomainEvent $domainEvent);

    public function allStoredEventsSince($anEventId);
}
