<?php
declare(strict_types=1);

namespace App\Store\Test\Clothes\Application\Query;

use App\Store\Categories\Domain\CategoryName;
use App\Store\Clothes\Application\Query\GetClothesWithDiscountsAppliedQuery;
use App\Store\Clothes\Application\Query\GetClothesWithDiscountsAppliedQueryHandler;
use App\Store\Clothes\Domain\ClothPrice;
use App\Store\Clothes\Domain\Service\ClothFinder;
use App\Store\Shared\Domain\PositiveIntegerValueObject;
use App\Store\Shared\Domain\StringValueObject;
use PHPUnit\Framework\TestCase;

class GetClothesWithDiscountsAppliedQueryHandlerTest extends TestCase
{
    private $clothFinder;
    private $queryHandler;

    public function setUp() : void
    {
        $this->clothFinder = $this->createMock(ClothFinder::class);

        $this->queryHandler = new GetClothesWithDiscountsAppliedQueryHandler(
            $this->clothFinder
        );
    }

    public function testThatCallsFinder()
    {
        $category = 'boots';
        $priceLessThan = 13000;

        $this->clothFinder
            ->expects($this->once())
            ->method('__invoke')
            ->with([new CategoryName($category), new ClothPrice($priceLessThan)]);

        ($this->queryHandler)(new GetClothesWithDiscountsAppliedQuery(
            $category,
            $priceLessThan
        ));
    }

    /** I'm aware that the name it's very long but i think it's easier to understand than a comment */
    public function testThatCallsFinderWithNullablePriceLessThan()
    {
        $category = 'boots';
        $priceLessThan = 13000;

        $this->clothFinder
            ->expects($this->once())
            ->method('__invoke')
            ->with([new CategoryName($category), null]);

        ($this->queryHandler)(new GetClothesWithDiscountsAppliedQuery(
            $category,
            null
        ));
    }
}
