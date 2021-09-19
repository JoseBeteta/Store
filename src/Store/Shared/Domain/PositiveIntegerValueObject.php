<?php
declare(strict_types=1);

namespace App\Store\Shared\Domain;

abstract class PositiveIntegerValueObject extends ValueObject
{
    public function __construct(int $value)
    {
        $this->assertValue($value);
        $this->value = $value;
    }

    private function assertValue(int $value)
    {
        if ($value < 0) {
            throw new \DomainException('Invalid integer value');
        }
    }

    public function value() : int
    {
        return $this->value;
    }
}
