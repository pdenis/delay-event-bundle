<?php


namespace Itkg\DelayEventBundle\Event;

use Itkg\DelayEventBundle\Model\Event;
use Symfony\Component\EventDispatcher\Event as BaseEvent;


/**
 * class FailProcessedEvent
 */
class FailProcessedEvent extends BaseEvent
{
    /**
     * @var Event
     */
    private $event;

    /**
     * @var int
     */
    private $maxRetryCount;

    /**
     * @param Event $event
     * @param int   $maxRetryCount
     */
    public function __construct(Event $event, $maxRetryCount = 0)
    {
        $this->event = $event;
        $this->maxRetryCount = $maxRetryCount;
    }

    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return int
     */
    public function getMaxRetryCount()
    {
        return $this->maxRetryCount;
    }
}
