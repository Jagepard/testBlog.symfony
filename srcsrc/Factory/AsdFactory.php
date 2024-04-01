<?php

namespace App\Factory;

use App\Service\MessageGenerator;
use Psr\Log\LoggerInterface;

class AsdFactory
{
    public function constructFoo(LoggerInterface $logger, $adminEmail)
    {
        return new MessageGenerator($logger, $adminEmail);
    }
}
