<?php

namespace Itkg\DelayEventBundle\EventListener;

use Itkg\DelayEventBundle\DomainManager\EventManagerInterface;
use Itkg\DelayEventBundle\Event\FailProcessedEvent;
use Itkg\DelayEventBundle\Event\ProcessedEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * class ManageFailedEventSubscriber 
 */
class ManageFailedEventSubscriber implements EventSubscriberInterface
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
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            ProcessedEvents::FAIL => 'onFail'
        );
    }

    /**
     * @param FailProcessedEvent $processedEvent
     */
    public function onFail(FailProcessedEvent $processedEvent)
    {
        $event = $processedEvent->getEvent();
        $event->increaseTryCount();
        if ($event->getTryCount() >= $processedEvent->getMaxRetryCount()) {
            $event->setFailed(true);
        }

        $this->eventManager->save($event);
    }
}
