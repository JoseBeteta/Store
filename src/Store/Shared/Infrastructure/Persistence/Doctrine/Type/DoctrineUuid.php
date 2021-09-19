<?php
declare(strict_types=1);

namespace App\Store\Shared\Infrastructure\Persistence\Doctrine\Type;

use App\Store\Shared\Domain\Uuid;

class DoctrineUuid extends DoctrineId
{
    public function className(): string
    {
        return Uuid::class;
    }
}
