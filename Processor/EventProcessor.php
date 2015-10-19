<?php

namespace Itkg\DelayEventBundle\Processor;

use Itkg\DelayEventBundle\Model\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class EventProcessor
 */
class EventProcessor implements EventProcessorInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
    /**
     * {@inheritDoc}
     */
    public function process(Event $event)
    {
        $this->eventDispatcher->dispatch($event->getOriginalName(), $event);
    }
}
