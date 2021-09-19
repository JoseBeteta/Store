<?php
declare(strict_types=1);

namespace App\Store\Discounts\Domain;

use App\Store\Categories\Domain\Category;

class Discount
{
    private $id;
    private $category;
    private $percentage;

    public function __construct(
        DiscountId $id,
        Category $category,
        Percentage $percentage
    ) {
        $this->id = $id;
        $this->category = $category;
        $this->percentage = $percentage;
    }

    public function percentage() : Percentage
    {
        return $this->percentage;
    }
}
