<?php
declare(strict_types=1);

namespace App\Store\Shared\Domain;

abstract class ValueObject
{
    protected $value;

    /**
     * @param ValueObject|self $o
     *
     * If you need to check a nullable ValueObject use this format
     * NullableObjectService::equalsValueObject(
     *  isset($this->balance) ? $this->balance : null,
     *  isset($o->balance) ? $o->balance : null
     * )
     *
     * @return bool
     */
    public function equals(ValueObject $o): bool
    {
        return get_class($this) === get_class($o) && $this->equalValues($o);
    }

    protected function equalValues(ValueObject $o): bool
    {
        return $this->value === $o->value();
    }
}
