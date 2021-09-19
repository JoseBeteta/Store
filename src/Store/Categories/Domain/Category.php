<?php
declare(strict_types=1);

namespace App\Store\Categories\Domain;

class Category
{
    private $id;
    private $name;

    public function __construct(
        CategoryId $id,
        CategoryName $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function id() : CategoryId
    {
        return $this->id;
    }

    public function name() : CategoryName
    {
        return $this->name;
    }
}
