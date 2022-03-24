<?php

namespace App\Store\Shared\Application;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class TestMessageHandler implements MessageHandlerInterface
{

    public function __invoke(TestMessage $message)
    {
        dump($message);
    }
}
