<?php

declare(strict_types=1);

namespace App\Store\Shared\Application\CommandBus;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

abstract class CommandHandler implements MessageHandlerInterface
{
}
