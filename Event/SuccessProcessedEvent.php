<?php


namespace Itkg\DelayEventBundle\Event;

use Itkg\DelayEventBundle\Model\Event;
use Symfony\Component\EventDispatcher\Event as BaseEvent;


/**
 * class SuccessProcessedEvent
 */
class SuccessProcessedEvent extends BaseEvent
{
    /**
     * @var Event
     */
    private $event;

    /**
     * @param Event $event
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }
}
