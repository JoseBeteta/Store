<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    App\Store\Discounts\Infrastructure\Symfony\Bundle\DiscountBundle::class => ['all' => true],
    App\Store\Categories\Infrastructure\Symfony\Bundle\CategoryBundle::class => ['all' => true],
    App\Store\Shared\Infrastructure\Symfony\Bundle\SharedBundle::class => ['all' => true],
    Enqueue\Bundle\EnqueueBundle::class => ['all' => true],
    Enqueue\MessengerAdapter\Bundle\EnqueueAdapterBundle::class => ['all' => true],
    Symfony\Bundle\MakerBundle\MakerBundle::class => ['dev' => true],
    JMS\SerializerBundle\JMSSerializerBundle::class => ['all' => true],
];
