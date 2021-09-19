<?php
declare(strict_types=1);

namespace App\Store\Discounts\Infrastructure\Persistence\Type;

use App\Store\Discounts\Domain\DiscountId;
use App\Store\Shared\Infrastructure\Persistence\Doctrine\Type\DoctrineId;

class DoctrineDiscountId extends DoctrineId
{
    public function className(): string
    {
        return DiscountId::class;
    }
}