<?php
declare(strict_types=1);

namespace App\Store\Discounts\Infrastructure\Persistence;

use App\Store\Categories\Domain\Category;
use App\Store\Discounts\Domain\Discount;
use App\Store\Discounts\Domain\DiscountCollection;
use App\Store\Discounts\Domain\DiscountId;
use App\Store\Discounts\Domain\DiscountRepositoryInterface;
use App\Store\Shared\Domain\Uuid;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class DoctrineDiscountRepositoryInterface extends EntityRepository implements DiscountRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(Discount::class));
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
        return new DiscountId(Uuid::create()->value());
    }
}
