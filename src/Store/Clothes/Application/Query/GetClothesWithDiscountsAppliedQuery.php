<?php
declare(strict_types=1);

namespace App\Store\Clothes\Application\Query;

use App\Store\Shared\Application\QueryBus\Query;

class GetClothesWithDiscountsAppliedQuery implements Query
{
    private $category;
    private $priceLessThan;

    public function __construct(
        string $category,
        ?int $priceLessThan
    ) {
        $this->category = $category;
        $this->priceLessThan = $priceLessThan;
    }

    public function category() : string
    {
        return $this->category;
    }

    public function priceLessThan() :? int
    {
        return $this->priceLessThan;
    }
}
