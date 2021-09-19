<?php
declare(strict_types=1);

namespace App\Store\Discounts\Domain;

use App\Store\Categories\Domain\Category;

interface DiscountRepositoryInterface
{
    public function findByCategory(Category $category) :? Discount;
}
