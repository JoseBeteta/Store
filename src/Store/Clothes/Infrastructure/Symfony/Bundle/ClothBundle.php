<?php

declare(strict_types=1);

namespace App\Store\Clothes\Infrastructure\Symfony\Bundle;

use App\Store\Clothes\Infrastructure\Symfony\DependencyInjection\ClothExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ClothBundle extends Bundle
{
    protected function getContainerExtensionClass()
    {
        return ClothExtension::class;
    }
}
