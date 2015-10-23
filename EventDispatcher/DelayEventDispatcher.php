<?php

namespace Itkg\DelayEventBundle\EventDispatcher;

use Itkg\DelayEventBundle\Event\DelayableEvent;
use Itkg\DelayEventBundle\Event\DelayableEvents;
use Symfony\Component\EventDispatcher\Event;
use Itkg\DelayEventBundle\Model\Event as DelayEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * class DelayEventDispatcher 
 */
class DelayEventDispatcher implements EventDispatcherInterface
{
    /**
     * @var array
     */
    private $eligibleEventNames = array();

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     * @param array                    $eligibleEventNames
     */
    public function __construct(EventDispatcherInterface $dispatcher, array $eligibleEventNames)
    {
        $this->dispatcher = $dispatcher;
        $this->eligibleEventNames = $eligibleEventNames;
    }

    /**
     * {@inheritDoc}
     */
    public function dispatch($eventName, Event $event = null)
    {
        if ($this->isEventEligible($eventName, $event)) {
            $event->setOriginalName($eventName);
            // Override event name to dispatch an delayable event
            $event = new DelayableEvent($event);
            $eventName = DelayableEvents::DELAY;
        }

        $this->dispatcher->dispatch($eventName, $event);

        return $event;
    }

    /**
     * {@inheritDoc}
     */
    public function addListener($eventName, $listener, $priority = 0)
    {
        $this->dispatcher->addListener($eventName, $listener, $priority);
    }

    /**
     * {@inheritDoc}
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->dispatcher->addSubscriber($subscriber);
    }

    /**
     * {@inheritDoc}
     */
    public function removeListener($eventName, $listener)
    {
        $this->dispatcher->removeListener($eventName, $listener);
    }

    /**
     * {@inheritDoc}
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->dispatcher->removeSubscriber($subscriber);
    }

    /**
     * {@inheritDoc}
     */
    public function getListeners($eventName = null)
    {
        return $this->dispatcher->getListeners($eventName);
    }

    /**
     * {@inheritDoc}
     */
    public function hasListeners($eventName = null)
    {
        return $this->dispatcher->hasListeners($eventName);
    }

    /**
     * Proxies all method calls to the original event dispatcher.
     *
     * @param string $method    The method name
     * @param array  $arguments The method arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array(array($this->dispatcher, $method), $arguments);
    }

    /**
     * @param String $eventName
     * @param Event $event
     *
     * @return bool
     */
    private function isEventEligible($eventName, $event)
    {
        return $event instanceof DelayEvent && $event->isDelayed() && in_array($eventName, $this->eligibleEventNames);
    }
}
