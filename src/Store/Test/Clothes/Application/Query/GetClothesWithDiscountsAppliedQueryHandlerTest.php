<?php
declare(strict_types=1);

namespace App\Store\Test\Clothes\Application\Query;

use App\Store\Categories\Domain\CategoryName;
use App\Store\Clothes\Application\Query\GetClothesWithDiscountsAppliedQuery;
use App\Store\Clothes\Application\Query\GetClothesWithDiscountsAppliedQueryHandler;
use App\Store\Clothes\Domain\ClothPrice;
use App\Store\Clothes\Domain\Service\ClothFinder;
use PHPUnit\Framework\TestCase;

class GetClothesWithDiscountsAppliedQueryHandlerTest extends TestCase
{
    private $clothFinderMock;
    private $queryHandler;

    public function setUp() : void
    {
        $this->clothFinderMock = $this->createMock(ClothFinder::class);

        $this->queryHandler = new GetClothesWithDiscountsAppliedQueryHandler(
            $this->clothFinderMock
        );
    }

    public function testThatCallsFinder()
    {
        $category = 'boots';
        $priceLessThan = 13000;

        $this->thenClothFinderShouldInvoke($category, $priceLessThan);

        ($this->queryHandler)(new GetClothesWithDiscountsAppliedQuery(
            $category,
            $priceLessThan
        ));
    }

    /** I'm aware that the name it's very long but i think it's easier to understand than a comment */
    public function testThatCallsFinderWithNullablePriceLessThan()
    {
        $category = 'boots';

        $this->thenClothFinderShouldInvoke($category, null);

        ($this->queryHandler)(new GetClothesWithDiscountsAppliedQuery(
            $category,
            null
        ));
    }

    private function thenClothFinderShouldInvoke(string $category, ?int $priceLessThan): void
    {
        $this->clothFinderMock
            ->expects($this->once())
            ->method('__invoke')
            ->with(new CategoryName($category), $priceLessThan ? new ClothPrice($priceLessThan) : null);
    }
}
