<?php
declare(strict_types=1);

namespace App\Store\Clothes\Domain;

use App\Store\Categories\Domain\Category;
use App\Store\Discounts\Domain\Discount;

class Cloth
{
    private $name;
    private $price;
    private $sku;
    private $category;
    private $discount;

    public function __construct(
        Sku $sku,
        ClothName $name,
        ClothPrice $price,
        Category $category,
        ?Discount $discount = null
    ) {
        $this->name = $name;
        $this->price = $price;
        $this->sku = $sku;
        $this->category = $category;
        $this->discount = $discount;
    }

    public function category()
    {
        return $this->category;
    }

    public function calculateDiscountAmount(Discount $discount) : ClothPrice
    {
        $discountAmount = $this->price->value() * ($discount->percentage()->value() / 100);

        return new ClothPrice((int) $discountAmount);
    }

    public function price() : ClothPrice
    {
        return $this->price;
    }

    public function discount() :? Discount
    {
        return $this->discount;
    }

    public function sku() : Sku
    {
        return $this->sku;
    }

    public function name() : ClothName
    {
        return $this->name;
    }
}
