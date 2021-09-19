<?php
declare(strict_types=1);

namespace App\Store\Shared\Domain;

abstract class StringValueObject extends ValueObject
{
    public function __construct(string $value)
    {
        $this->assertValue($value);
        $this->value = $value;
    }

    private function assertValue(string $value)
    {
        $length = strlen($value);
        if ($length <= 0) {
            throw new \DomainException('Invalid string value');
        }
    }

    public function value() : string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
