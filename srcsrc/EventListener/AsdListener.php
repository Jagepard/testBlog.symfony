<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class AsdListener
{
    #[AsEventListener(event: 'asd')]
    public function onAsd($event): void
    {
        echo 123;
        dump(__METHOD__);
    }
}
