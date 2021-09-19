<?php
declare(strict_types=1);

namespace App\Store\Categories\Infrastructure\Persistence\Type;

use App\Store\Categories\Domain\CategoryId;
use App\Store\Shared\Infrastructure\Persistence\Doctrine\Type\DoctrineId;

class DoctrineCategoryId extends DoctrineId
{
    public function className(): string
    {
        return CategoryId::class;
    }
}