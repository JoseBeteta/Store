<?php
declare(strict_types=1);

namespace App\Store\Discounts\Domain;

use App\Store\Categories\Domain\Category;

class Discount
{
    private $id;
    private $percentage;

    public function __construct(
        DiscountId $id,
        Percentage $percentage
    ) {
        $this->id = $id;
        $this->percentage = $percentage;
    }

    public function percentage() : Percentage
    {
        return $this->percentage;
    }
}
