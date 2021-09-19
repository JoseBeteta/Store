<?php

declare(strict_types=1);

namespace App\Store\Discounts\Infrastructure\Symfony\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\GlobFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class DiscountExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $locator = new FileLocator(__DIR__.DIRECTORY_SEPARATOR.'Resources');
        $resolver = new LoaderResolver(
            [
                new YamlFileLoader($container, $locator),
                new GlobFileLoader($container, $locator),
            ]
        );

        $loader = new DelegatingLoader($resolver);
        $this->loadServiceConfigurations($loader);
    }

    /**
     * @param DelegatingLoader $loader
     *
     * @throws Exception
     */
    private function loadServiceConfigurations(DelegatingLoader $loader): void
    {
        $loader->load('{discount_extension}.yaml', 'glob');
    }
}
