<?php
declare(strict_types=1);

namespace App\Store\Clothes\Application\Query;

use App\Store\Categories\Domain\CategoryName;
use App\Store\Clothes\Domain\ClothPrice;
use App\Store\Clothes\Domain\Service\ClothFinder;
use App\Store\Shared\Application\QueryBus\QueryHandler;

class GetClothesWithDiscountsAppliedQueryHandler extends QueryHandler
{
    private $clothFinder;

    public function __construct(ClothFinder $clothFinder)
    {
        $this->clothFinder = $clothFinder;
    }

    public function __invoke(GetClothesWithDiscountsAppliedQuery $query)
    {
        return ($this->clothFinder)(
            new CategoryName($query->category()),
            $query->priceLessThan() ? new ClothPrice($query->priceLessThan()) : null
        );
    }
}
