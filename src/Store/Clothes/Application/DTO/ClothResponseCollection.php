<?php
declare(strict_types=1);

namespace App\Store\Clothes\Application\DTO;

use App\Store\Shared\Domain\Collection;

class ClothResponseCollection extends Collection
{
    public function toResponseArray()
    {
        $responses = [];
        /** @var ClothResponse $clothResponse */
        foreach ($this->getIterator() as $clothResponse) {
            $responses[] = $clothResponse->toArray();
        }

        return $responses;
    }
}
