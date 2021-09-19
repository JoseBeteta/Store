<?php
declare(strict_types=1);

namespace App\Store\Test\Clothes\Domain;

use App\Store\Categories\Domain\Category;
use App\Store\Categories\Domain\CategoryId;
use App\Store\Categories\Domain\CategoryName;
use App\Store\Clothes\Domain\Cloth;
use App\Store\Clothes\Domain\ClothName;
use App\Store\Clothes\Domain\ClothPrice;
use App\Store\Clothes\Domain\Sku;
use App\Store\Discounts\Domain\Discount;
use App\Store\Discounts\Domain\DiscountId;
use App\Store\Discounts\Domain\Percentage;
use App\Store\Shared\Domain\Uuid;
use PHPUnit\Framework\TestCase;

class ClothTest extends TestCase
{
    /** @var Cloth $cloth */
    private $cloth;

    public function setUp(): void
    {
        $this->cloth = new Cloth(
            new Sku('00001'),
            new ClothName('name'),
            new ClothPrice(30000),
            new Category(
                new CategoryId(Uuid::create()->value()),
                new CategoryName('name')
            ),
            new Discount(
                new DiscountId(Uuid::create()->value()),
                new Percentage(10)
            )
        );
    }

    public function testCalculateDiscount()
    {
        $discount = $this->cloth->calculateDiscountAmount(new Discount(
            new DiscountId(Uuid::create()->value()),
            new Percentage(10)
        ));

        $this->assertEquals(3000, $discount->value());
    }
}
