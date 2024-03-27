<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AsdSubscriber implements EventSubscriberInterface
{
    public function onAfaf($event): void
    {
        echo 456;
        dump(__METHOD__);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'afaf' => 'onAfaf',
        ];
    }
}
