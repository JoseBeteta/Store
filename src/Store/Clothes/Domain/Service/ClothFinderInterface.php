<?php

namespace App\Store\Clothes\Domain\Service;

use App\Store\Categories\Domain\CategoryName;
use App\Store\Clothes\Application\DTO\ClothResponseCollection;
use App\Store\Clothes\Domain\ClothPrice;

interface ClothFinderInterface
{
    public function __invoke(
        CategoryName $categoryName,
        ?ClothPrice $priceLessThan = null
    ): ClothResponseCollection;
}