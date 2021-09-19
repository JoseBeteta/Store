<?php

declare(strict_types=1);

namespace App\Store\Categories\Infrastructure\Symfony\Bundle;

use App\Store\Categories\Infrastructure\Symfony\DependencyInjection\CategoryExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CategoryBundle extends Bundle
{
    protected function getContainerExtensionClass()
    {
        return CategoryExtension::class;
    }
}
