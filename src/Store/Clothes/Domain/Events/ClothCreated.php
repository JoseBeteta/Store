<?php
declare(strict_types=1);

namespace App\Store\Clothes\Domain\Events;

use App\Store\Clothes\Domain\Sku;
use App\Store\Shared\Domain\DomainEvent;

class ClothCreated implements DomainEvent
{
    private $sku;
    private $occurredOn;

    public function __construct(Sku $sku)
    {
        $this->sku = $sku;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function resourceId() : string
    {
        return $this->sku->value();
    }

    public function occurredOn() : \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}