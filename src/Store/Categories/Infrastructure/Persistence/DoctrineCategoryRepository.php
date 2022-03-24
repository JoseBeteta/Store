<?php
declare(strict_types=1);

namespace App\Store\Categories\Infrastructure\Persistence;

use App\Store\Categories\Domain\Category;
use App\Store\Categories\Domain\CategoryCollection;
use App\Store\Categories\Domain\CategoryId;
use App\Store\Categories\Domain\CategoryRepositoryInterface;
use App\Store\Shared\Domain\UuidProvider;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class DoctrineCategoryRepository extends EntityRepository implements CategoryRepositoryInterface
{
    private $uuidProvider;

    public function __construct(EntityManagerInterface $em, UuidProvider $provider)
    {
        $this->uuidProvider = $provider;
        parent::__construct($em, new ClassMetadata(Category::class));
    }

    public function save(Category $category): void
    {
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();
    }

    public function saveCollection(CategoryCollection $categoryCollection) : void
    {
        foreach ($categoryCollection->getIterator() as $category)
        {
            $this->getEntityManager()->persist($category);
        }
        $this->getEntityManager()->flush();
    }

    public function nextId(): CategoryId
    {
        return new CategoryId($this->uuidProvider->provide());
    }
}
