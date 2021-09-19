<?php
declare(strict_types=1);

namespace App\Store\Shared\Domain;

use Exception;
use Ramsey\Uuid\Uuid as RamseyUuid;
use ShoppingCart\Common\Types\Domain\Exception\InvalidUuidClassException;
use ShoppingCart\Common\Types\Domain\Exception\InvalidUuidException;

class Uuid extends ValueObject
{
    /**
     * @var string
     */
    protected $value;

    public function __construct(string $value)
    {
        $this->setValue($value);
    }

    /**
     * @return Uuid
     * @throws Exception
     */
    public static function create(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    private function setValue(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    private function guard(string $value): void
    {
        $UUIDv4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
        if (!preg_match($UUIDv4, $value)) {
            throw new InvalidUuidException($value);
        }

    }

    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @param self|ValueObject $o
     *
     * @return bool
     */
    protected function equalValues(ValueObject $o): bool
    {
        return $this->value() == $o->value();
    }
}
