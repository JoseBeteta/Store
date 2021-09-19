<?php
declare(strict_types=1);

namespace App\Store\Clothes\Application\DTO;

use App\Store\Categories\Domain\CategoryName;
use App\Store\Clothes\Domain\ClothPrice;
use App\Store\Clothes\Domain\ClothName;
use App\Store\Clothes\Domain\Sku;
use App\Store\Discounts\Domain\Percentage;

class ClothResponse
{
    private $sku;
    private $name;
    private $categoryName;
    private $priceWithoutDiscount;
    private $priceWithDiscount;
    private $discountPercentage;

    public function __construct(
        Sku $sku,
        ClothName $name,
        CategoryName $categoryName,
        ClothPrice $priceWithoutDiscount,
        ClothPrice $priceWithDisocunt,
        ?Percentage $discountPercentage
    ) {

        $this->sku = $sku;
        $this->name = $name;
        $this->categoryName = $categoryName;
        $this->priceWithoutDiscount = $priceWithoutDiscount;
        $this->priceWithDiscount = $priceWithDisocunt;
        $this->discountPercentage = $discountPercentage;
    }

    public function toArray() :array
    {
        return [
            'sku' => $this->sku->value(),
            'name' => $this->name->value(),
            'category' => $this->categoryName->value(),
            'price' => [
                'original' => $this->priceWithoutDiscount->value(),
                'final' => $this->priceWithDiscount->value(),
                'discount_percentage' => $this->discountPercentage ? $this->discountPercentage->value() . '%' : null,
                'currency' => ClothPrice::CURRENCY
            ]
        ];
    }
}
