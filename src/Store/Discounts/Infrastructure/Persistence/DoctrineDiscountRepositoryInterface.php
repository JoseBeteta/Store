<?php
declare(strict_types=1);

namespace App\Store\Discounts\Infrastructure\Persistence;

use App\Store\Categories\Domain\Category;
use App\Store\Discounts\Domain\Discount;
use App\Store\Discounts\Domain\DiscountRepositoryInterface;
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

    public function findByCategory(Category $category) :?Discount
    {
        return $this->findOneBy(['category' => $category]);
    }
}
