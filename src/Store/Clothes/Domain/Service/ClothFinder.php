<?php
declare(strict_types=1);

namespace App\Store\Clothes\Domain\Service;

use App\Store\Categories\Domain\CategoryName;
use App\Store\Clothes\Application\DTO\ClothResponse;
use App\Store\Clothes\Application\DTO\ClothResponseCollection;
use App\Store\Clothes\Domain\Cloth;
use App\Store\Clothes\Domain\ClothRepositoryInterface;
use App\Store\Clothes\Domain\ClothPrice;

class ClothFinder
{
    private $clothRepository;

    public function __construct(ClothRepositoryInterface $clothRepository) {
        $this->clothRepository = $clothRepository;
    }

    public function __invoke(
        CategoryName $categoryName,
        ?ClothPrice $priceLessThan = null
    ): ClothResponseCollection
    {
        $clothes = $this->clothRepository->findAllBy(
            $categoryName,
            $priceLessThan
        );

        $clothesResponse = [];
        /** @var Cloth $cloth */
        foreach ($clothes->getIterator() as $cloth)
        {
            [$discountAmount, $discount] = $this->calculateDiscount($cloth);

            $clothesResponse [] = new ClothResponse(
                $cloth->sku(),
                $cloth->name(),
                $cloth->category()->name(),
                $cloth->price(),
                new ClothPrice($cloth->price()->value() - $discountAmount->value()),
                $discount ? $discount->percentage() : null
            );
        }

        return new ClothResponseCollection($clothesResponse);
    }

    private function calculateDiscount(Cloth $cloth): array
    {
        $discountByCategory = $cloth->category()->discount();
        $discount = $cloth->discount();

        if ($discountByCategory && $discount) {
            if ($discountByCategory->percentage()->value() > $discount->percentage()->value()) {
                return [$cloth->calculateDiscountAmount($discountByCategory), $discountByCategory];
            }
            return [$cloth->calculateDiscountAmount($discount), $discount];
        }

        if ($discountByCategory) {
            return [$cloth->calculateDiscountAmount($discountByCategory), $discountByCategory];
        }

        if ($discount) {
            return [$cloth->calculateDiscountAmount($discount), $discount];
        }

        return [new ClothPrice(0), null];
    }
}
