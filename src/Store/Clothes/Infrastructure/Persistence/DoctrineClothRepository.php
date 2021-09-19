<?php
declare(strict_types=1);

namespace App\Store\Clothes\Infrastructure\Persistence;

use App\Store\Categories\Domain\CategoryName;
use App\Store\Clothes\Domain\Cloth;
use App\Store\Clothes\Domain\ClothCollection;
use App\Store\Clothes\Domain\ClothPrice;
use App\Store\Clothes\Domain\ClothRepositoryInterface;
use App\Store\Shared\Domain\Uuid;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class DoctrineClothRepository extends EntityRepository implements ClothRepositoryInterface
{
    private const MAX_RESULTS = 5;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(Cloth::class));
    }

    public function findAllBy(
        CategoryName $categoryName,
        ?ClothPrice $priceLessThan = null
    ) : ClothCollection
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->setMaxResults(self::MAX_RESULTS)
                ->innerJoin('c.category' ,'ca')
                ->where('ca.name.value = :categoryName')
                ->setParameter('categoryName', $categoryName->value());

        if ($priceLessThan) {
            $queryBuilder
                ->andWhere('c.price.value <= :priceLessThan')
                ->setParameter('priceLessThan', $priceLessThan->value());
        }

        $result = $queryBuilder->getQuery()->getResult();

        return new ClothCollection($result);
    }

    public function save(Cloth $cloth): void
    {
        $this->getEntityManager()->persist($cloth);
        $this->getEntityManager()->flush();
    }

    public function saveCollection(ClothCollection $clothCollection): void
    {
        foreach ($clothCollection->getIterator() as $cloth) {
            $this->getEntityManager()->persist($cloth);
        }
        $this->getEntityManager()->flush();
    }
}
