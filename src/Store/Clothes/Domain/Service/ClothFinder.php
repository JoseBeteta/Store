<?php
declare(strict_types=1);

namespace App\Store\Clothes\Domain\Service;

use App\Store\Categories\Domain\CategoryName;
use App\Store\Clothes\Application\DTO\ClothResponse;
use App\Store\Clothes\Application\DTO\ClothResponseCollection;
use App\Store\Clothes\Domain\Cloth;
use App\Store\Clothes\Domain\ClothRepositoryInterface;
use App\Store\Clothes\Domain\ClothPrice;
use App\Store\Discounts\Domain\DiscountRepositoryInterface;

class ClothFinder
{
    private $discountRepository;
    private $clothRepository;

    public function __construct(
        ClothRepositoryInterface $clothRepository,
        DiscountRepositoryInterface $discountRepository
    ) {
        $this->discountRepository = $discountRepository;
        $this->clothRepository = $clothRepository;
    }

    public function __invoke(
        CategoryName $categoryName,
        ?ClothPrice $price = null
    ): ClothResponseCollection
    {
        $clothes = $this->clothRepository->findAllBy(
            $categoryName,
            $price
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
        $discountByCategory = $this->discountRepository->findByCategory($cloth->category());
        $discount = $cloth->discount();

        if ($discountByCategory && $discount) {
            if ($discountByCategory->percentage()->value() > $discount->percentage()->value()) {
                return [$cloth->calculateDiscountAmount($discountByCategory), $discount];
            }
            return [$cloth->calculateDiscountAmount($discount), $discount];
        }

        if ($discountByCategory) {
            return [$cloth->calculateDiscountAmount($discount), $discount];
        }

        if ($discount) {
            return [$cloth->calculateDiscountAmount($discount), $discount];
        }

        return [0, null];
    }
}
