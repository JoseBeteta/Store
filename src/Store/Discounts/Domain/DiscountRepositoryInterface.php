<?php
declare(strict_types=1);

namespace App\Store\Discounts\Domain;

interface DiscountRepositoryInterface
{
    public function save(Discount $discount) : void;

    public function nextId() : DiscountId;

    public function saveCollection(DiscountCollection $discountCollection) : void;
}
