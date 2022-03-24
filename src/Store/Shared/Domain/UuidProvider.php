<?php
declare(strict_types=1);

namespace App\Store\Shared\Domain;

interface UuidProvider
{
    public function provide() : string;
}
