<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    App\Store\Discounts\Infrastructure\Symfony\Bundle\DiscountBundle::class => ['all' => true],
    App\Store\Categories\Infrastructure\Symfony\Bundle\CategoryBundle::class => ['all' => true],
];
