<?php

declare(strict_types=1);

namespace App\Store\Discounts\Infrastructure\Symfony\Bundle;

use App\Store\Discounts\Infrastructure\Symfony\DependencyInjection\DiscountExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DiscountBundle extends Bundle
{
    protected function getContainerExtensionClass()
    {
        return DiscountExtension::class;
    }
}
