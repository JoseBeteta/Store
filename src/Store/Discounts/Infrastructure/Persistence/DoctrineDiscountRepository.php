<?php
declare(strict_types=1);

namespace App\Store\Discounts\Infrastructure\Persistence;

use App\Store\Discounts\Domain\Discount;
use App\Store\Discounts\Domain\DiscountCollection;
use App\Store\Discounts\Domain\DiscountId;
use App\Store\Discounts\Domain\DiscountRepositoryInterface;
use App\Store\Shared\Domain\UuidProvider;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

final class DoctrineDiscountRepository extends EntityRepository implements DiscountRepositoryInterface
{
    private $uuidProvider;

    public function __construct(
        EntityManagerInterface $em,
        UuidProvider $provider
    ) {
        parent::__construct($em, new ClassMetadata(Discount::class));
        $this->uuidProvider = $provider;
    }

    public function save(Discount $discount): void
    {
        $this->getEntityManager()->persist($discount);
        $this->getEntityManager()->flush();
    }

    public function saveCollection(DiscountCollection $discountCollection): void
    {
        foreach ($discountCollection->getIterator() as $discount) {
            $this->getEntityManager()->persist($discount);
        }
        $this->getEntityManager()->flush();
    }

    public function nextId(): DiscountId
    {
        return new DiscountId($this->uuidProvider->provide());
    }
}
