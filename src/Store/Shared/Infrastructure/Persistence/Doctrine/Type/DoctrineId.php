<?php

declare(strict_types=1);

namespace App\Store\Shared\Infrastructure\Persistence\Doctrine\Type;

use App\Store\Shared\Domain\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

abstract class DoctrineId extends GuidType
{
    abstract public function className(): string;

    /**
     * @param string           $value
     * @param AbstractPlatform $platform
     *
     * @return Uuid
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Uuid
    {
        if (null === $value) {
            return null;
        }

        $className = $this->className();

        return new $className($value);
    }

    /**
     * @param Uuid|string             $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value === null ? null : $value->value();
    }
}
