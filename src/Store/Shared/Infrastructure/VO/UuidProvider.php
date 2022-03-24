<?php
declare(strict_types=1);

namespace App\Store\Shared\Infrastructure\VO;

use App\Store\Shared\Domain\UuidProvider as UuidProviderInterface;
use Ramsey\Uuid\Uuid;

class UuidProvider implements UuidProviderInterface
{
    public function provide(): string
    {
        return Uuid::uuid4()->toString();
    }
}
