<?php
declare(strict_types=1);

namespace App\Store\Clothes\Domain;

use App\Store\Categories\Domain\CategoryName;

interface ClothRepositoryInterface
{
    public function findAllBy(
        CategoryName $categoryName,
        ?ClothPrice $clothPrice = null
    ) : ClothCollection;

    public function save(Cloth $cloth) : void;

    public function saveCollection(ClothCollection $clothCollection) : void;
}
