<?php
declare(strict_types=1);

namespace App\Store\Clothes\Domain;

use App\Store\Shared\Domain\PositiveIntegerValueObject;

class ClothPrice extends PositiveIntegerValueObject
{
    public const CURRENCY = 'EUR';
}
