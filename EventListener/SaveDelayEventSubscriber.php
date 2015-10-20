<?php

namespace Itkg\DelayEventBundle\EventListener;

use Itkg\DelayEventBundle\DomainManager\EventManagerInterface;
use Itkg\DelayEventBundle\Event\DelayableEvent;
use Itkg\DelayEventBundle\Event\DelayableEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * class SaveDelayEventSubscriber 
 */
class SaveDelayEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var EventManagerInterface
     */
    private $eventManager;

    /**
     * @param EventManagerInterface $eventManager
     */
    public function __construct(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(DelayableEvents::DELAY => 'onDelay');
    }

    /**
     * @param DelayableEvent $event
     */
    public function onDelay(DelayableEvent $event)
    {
        $this->eventManager->save($event->getDelayedEvent());
    }
}
