<?php

namespace App\Service;

use App\Interface\AsdInterface;
use Psr\Log\LoggerInterface;

class MessageGenerator234 implements AsdInterface
{
    public function __construct(
        private LoggerInterface $logger,
        public $adminEmail
    ) {
    }

    public function getHappyMessage(): string
    {
        dump(__METHOD__);
        dump($this->logger);
        dump($this->adminEmail);

        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}
