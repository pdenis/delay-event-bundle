<?php

namespace Itkg\DelayEventBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Itkg\DelayEventBundle\Model\Event as DelayEvent;

/**
 * class DelayableEvent 
 */
class DelayableEvent extends Event
{
    /**
     * @var DelayEvent
     */
    private $delayedEvent;

    /**
     * @param DelayEvent $delayedEvent
     */
    public function __construct(DelayEvent $delayedEvent)
    {
        $this->delayedEvent = $delayedEvent;
    }

    /**
     * @return DelayEvent
     */
    public function getDelayedEvent()
    {
        return $this->delayedEvent;
    }
}
