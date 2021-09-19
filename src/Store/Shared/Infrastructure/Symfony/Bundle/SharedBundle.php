<?php

declare(strict_types=1);

namespace App\Store\Shared\Infrastructure\Symfony\Bundle;

use App\Store\Shared\Infrastructure\Symfony\DependencyInjection\SharedExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SharedBundle extends Bundle
{
    protected function getContainerExtensionClass()
    {
        return SharedExtension::class;
    }
}
