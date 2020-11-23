<?php

namespace App\EventListener;

use App\Event\ExecuteJobEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExecuteJobListener implements EventSubscriberInterface
{
    /**
     * @return array <string, array <string>>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ExecuteJobEvent::NAME => ['onExecuteJob'],
        ];
    }

    /**
     * @param ExecuteJobEvent $executeJobEvent
     */
    public function onExecuteJob(ExecuteJobEvent $executeJobEvent): void
    {
        exec($executeJobEvent->getCommand());
    }
}
