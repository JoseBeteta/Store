<?php
declare(strict_types=1);

namespace App\Store\Test\Clothes\Domain\Service;

use App\Store\Categories\Domain\Category;
use App\Store\Categories\Domain\CategoryId;
use App\Store\Categories\Domain\CategoryName;
use App\Store\Clothes\Application\DTO\ClothResponse;
use App\Store\Clothes\Application\DTO\ClothResponseCollection;
use App\Store\Clothes\Domain\Cloth;
use App\Store\Clothes\Domain\ClothCollection;
use App\Store\Clothes\Domain\ClothName;
use App\Store\Clothes\Domain\ClothPrice;
use App\Store\Clothes\Domain\ClothRepositoryInterface;
use App\Store\Clothes\Domain\Service\ClothFinder;
use App\Store\Clothes\Domain\Sku;
use App\Store\Discounts\Domain\Discount;
use App\Store\Discounts\Domain\DiscountId;
use App\Store\Discounts\Domain\Percentage;
use App\Store\Shared\Domain\Uuid;
use PHPUnit\Framework\TestCase;

class ClothFinderTest extends TestCase
{
    private $clothRepositoryMock;
    private $finder;

    public function setUp(): void
    {
        $this->clothRepositoryMock = $this->createMock(ClothRepositoryInterface::class);

        $this->finder = new ClothFinder(
            $this->clothRepositoryMock
        );
    }

    /** @dataProvider dataProviderClothes */
    public function testThatReturnsClothesWithAppliedDiscounts(
        ClothCollection $clothCollection,
        ClothResponseCollection $expectedClothResponseCollection
    ) {
        $categoryName = new CategoryName('shoes');
        $priceLessThan = new ClothPrice(30000);

        $this->thenClothRepositoryWillFindClothes($categoryName, $priceLessThan, $clothCollection);

        $this->assertEquals(
            $expectedClothResponseCollection,
            ($this->finder)($categoryName, $priceLessThan)
        );
    }

    public function dataProviderClothes()
    {
        return [
            [
                new ClothCollection([
                    new Cloth(
                        new Sku('00001'),
                        new ClothName('shoes'),
                        new ClothPrice(30000),
                        new Category(
                            new CategoryId(Uuid::create()->value()),
                            new CategoryName('shoes')
                        )
                    )]
                ),
                new ClothResponseCollection([
                    new ClothResponse(
                        new Sku('00001'),
                        new ClothName('shoes'),
                        new CategoryName('shoes'),
                        new ClothPrice(30000),
                        new ClothPrice(30000),
                        null
                    )]
                )
            ],
            [
                new ClothCollection([
                        new Cloth(
                            new Sku('00001'),
                            new ClothName('shoes'),
                            new ClothPrice(10000),
                            new Category(
                                new CategoryId(Uuid::create()->value()),
                                new CategoryName('shoes'),
                                new Discount(
                                    new DiscountId(Uuid::create()->value()),
                                    new Percentage(10)
                                )
                            ),
                            new Discount(
                                new DiscountId(Uuid::create()->value()),
                                new Percentage(5)
                            )
                        )]
                ),
                new ClothResponseCollection([
                        new ClothResponse(
                            new Sku('00001'),
                            new ClothName('shoes'),
                            new CategoryName('shoes'),
                            new ClothPrice(10000),
                            new ClothPrice(9000),
                            new Percentage(10)
                        )]
                )
            ]
        ];
    }

    private function thenClothRepositoryWillFindClothes(
        CategoryName $categoryName,
        ClothPrice $priceLessThan,
        ClothCollection $clothCollection
    ): void {
        $this->clothRepositoryMock
            ->expects(self::once())
            ->method('findAllBy')
            ->with($categoryName, $priceLessThan)
            ->willReturn($clothCollection);
    }
}
