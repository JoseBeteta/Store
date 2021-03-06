<?php

declare(strict_types=1);

namespace App\Store\Shared\Application\Exception;

use DomainException as SPLDomainException;

abstract class ApplicationException extends SPLDomainException
{
    /**
     * @var string
     */
    private $errorMessage;

    public function __construct(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
        parent::__construct($this->errorMessage());
    }

    protected function errorMessage(): string
    {
        return $this->errorMessage;
    }
}
