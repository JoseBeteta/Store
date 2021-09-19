<?php
declare(strict_types=1);

namespace App\Store\Shared\Infrastructure\Symfony\Command;

use App\Store\Categories\Domain\Category;
use App\Store\Categories\Domain\CategoryCollection;
use App\Store\Categories\Domain\CategoryName;
use App\Store\Categories\Domain\CategoryRepositoryInterface;
use App\Store\Clothes\Domain\Cloth;
use App\Store\Clothes\Domain\ClothCollection;
use App\Store\Clothes\Domain\ClothName;
use App\Store\Clothes\Domain\ClothPrice;
use App\Store\Clothes\Domain\ClothRepositoryInterface;
use App\Store\Clothes\Domain\Sku;
use App\Store\Discounts\Domain\Discount;
use App\Store\Discounts\Domain\DiscountCollection;
use App\Store\Discounts\Domain\DiscountRepositoryInterface;
use App\Store\Discounts\Domain\Percentage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PrepareDatabaseCommand extends Command
{
    private const NAME = 'mytheresa:database:prepare';

    private $clothRepository;
    private $discountRepository;
    private $categoryRepository;

    public function __construct(
        ClothRepositoryInterface $clothRepository,
        DiscountRepositoryInterface $discountRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        parent::__construct(self::NAME);
        $this->clothRepository = $clothRepository;
        $this->discountRepository = $discountRepository;
        $this->categoryRepository = $categoryRepository;
    }

    protected function configure()
    {
        $this->setDescription('Prepare database for the challenge.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        [$fifteenDiscount, $thirtyDiscount] = $this->createDiscounts();
        [$bootsCategory, $sandalsCategory, $sneakersCategory] = $this->createCategories($thirtyDiscount);
        $this->createClothes(
            $bootsCategory,
            $sandalsCategory,
            $sneakersCategory,
            $fifteenDiscount
        );
        $output->write('Database ready =)');

        return Command::SUCCESS;
    }

    private function createCategories(Discount $thirtyDiscount) : array
    {
        $bootsCategory = new Category(
            $this->categoryRepository->nextId(),
            new CategoryName('boots'),
            $thirtyDiscount
        );

        $sandalsCategory = new Category(
            $this->categoryRepository->nextId(),
            new CategoryName('sandals')
        );

        $sneakersCategory = new Category(
            $this->categoryRepository->nextId(),
            new CategoryName('sneakers')
        );

        $this->categoryRepository->saveCollection(
            new CategoryCollection([$bootsCategory, $sandalsCategory, $sneakersCategory])
        );

        return [$bootsCategory, $sandalsCategory, $sneakersCategory];
    }

    private function createDiscounts() : array
    {
        $fifteenDiscount = new Discount(
            $this->discountRepository->nextId(),
            new Percentage(15)
        );

        $thirtyDiscount = new Discount(
            $this->discountRepository->nextId(),
            new Percentage(30)
        );

        $this->discountRepository->saveCollection(
            new DiscountCollection([$fifteenDiscount, $thirtyDiscount])
        );

        return [$fifteenDiscount, $thirtyDiscount];
    }

    private function createClothes(
        Category $bootsCategory,
        Category $sandalsCategory,
        Category $sneakersCategory,
        Discount $fifteenDiscount
    ) : void {
        $cloth1 = new Cloth(
            new Sku('000001'),
            new ClothName('BV Lean leather ankle boots'),
            new ClothPrice(89000),
            $bootsCategory
        );
        
        $cloth2 = new Cloth(
            new Sku('000002'),
            new ClothName('BV Lean leather ankle boots'),
            new ClothPrice(99000),
            $bootsCategory
        );
        
        $cloth3 = new Cloth(
            new Sku('000003'),
            new ClothName('Ashlington leather ankle boots'),
            new ClothPrice(71000),
            $bootsCategory,
            $fifteenDiscount
        );
        
        $cloth4 = new Cloth(
            new Sku('000004'),
            new ClothName('Naima embellished suede sandals'),
            new ClothPrice(79500),
            $sandalsCategory
        );

        $cloth5 = new Cloth(
            new Sku('000005'),
            new ClothName('Nathane leather sneakers'),
            new ClothPrice(59000),
            $sneakersCategory
        );
        
        $this->clothRepository->saveCollection(
            new ClothCollection([$cloth1, $cloth2, $cloth3, $cloth4, $cloth5])
        );
    }

}
