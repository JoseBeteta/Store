<?php
declare(strict_types=1);

namespace App\Store\Categories\Domain;

interface CategoryRepositoryInterface
{
    public function save(Category $category): void;

    public function saveCollection(CategoryCollection $categoryCollection): void;

    public function nextId() : CategoryId;
}
