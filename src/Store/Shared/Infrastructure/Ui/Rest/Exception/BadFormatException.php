<?php

namespace ShoppingCart\Common\Types\Infrastructure\Ui\Http\Rest\Exception;

use Throwable;

/**
 * Class BadFormatException
 */
class BadFormatException extends \Exception
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, 400, $previous);
    }
}