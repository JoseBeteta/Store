<?php
declare(strict_types=1);

namespace App\Store\Clothes\Infrastructure\Persistence\Type;

use App\Store\Clothes\Domain\Sku;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class DoctrineSku extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof Sku) {
            return $value->value();
        }

        return null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Sku($value);
    }
}