<?php
declare(strict_types=1);

namespace App\Store\Categories\Domain;

use App\Store\Discounts\Domain\Discount;

class Category
{
    private $id;
    private $name;
    private $discount;

    public function __construct(
        CategoryId $id,
        CategoryName $name,
        ?Discount $discount = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->discount = $discount;
    }

    public function id() : CategoryId
    {
        return $this->id;
    }

    public function name() : CategoryName
    {
        return $this->name;
    }

    public function discount(): ?Discount
    {
        return $this->discount;
    }
}
