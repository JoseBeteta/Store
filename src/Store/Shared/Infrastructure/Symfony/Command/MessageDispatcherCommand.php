<?php

namespace App\Store\Shared\Infrastructure\Symfony\Command;

use App\Store\Shared\Application\TestMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class MessageDispatcherCommand extends Command
{
    protected static $defaultName = 'app:message:dispatcher';

    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    /**
     * MessageDispatcherCommand constructor.
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
        $this->setDescription('Dispatch a message to the configured queuing system');
        parent::__construct(self::$defaultName);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $message = new TestMessage();
        $message->setPayload(date('Y-m-d H:i:s') . ' here is my content');
        $this->messageBus->dispatch($message);

        $io->success('Message dispatched successfully!');

        return 0;
    }
}