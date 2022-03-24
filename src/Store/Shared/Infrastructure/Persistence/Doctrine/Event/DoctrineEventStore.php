<?php

namespace App\Store\Shared\Infrastructure\Persistence\Doctrine\Event;

use App\Store\Shared\Domain\DomainEvent;
use App\Store\Shared\Domain\StoredEvent;
use App\Store\Shared\Infrastructure\Event\EventStore;
use Doctrine\ORM\EntityRepository;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class DoctrineEventStore extends EntityRepository implements EventStore
{
    private $serializer;

    public function append(DomainEvent $domainEvent) : void
    {
        $storedEvent = new StoredEvent(
            get_class($domainEvent),
            $domainEvent->occurredOn(),
            $this->serializer()->serialize($domainEvent, 'json'),
            $domainEvent->resourceId()
        );

        $this->getEntityManager()->persist($storedEvent);
    }

    public function allStoredEventsSince($anEventId)
    {
        $query = $this->createQueryBuilder('e');
        if ($anEventId) {

            $query->where('e.eventId > :eventId');
            $query->setParameters(['eventId' => $anEventId]);
        }
        $query->orderBy('e.eventId');
        return $query->getQuery()->getResult();
    }

    private function serializer() : SerializerInterface
    {
        if (null === $this->serializer) {
            $this->serializer = SerializerBuilder::create()->build();
        }
        return $this->serializer;
    }
}