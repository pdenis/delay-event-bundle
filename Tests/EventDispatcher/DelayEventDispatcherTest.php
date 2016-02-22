<?php
namespace Itkg\DelayEventBundle\Tests\EventDispatcher;

use Itkg\DelayEventBundle\Event\DelayableEvents;
use Itkg\DelayEventBundle\EventDispatcher\DelayEventDispatcher;
use Phake;

/**
 * Class DelayEventDispatcherTest
 */
class DelayEventDispatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DelayEventDispatcher
     */
    private $dispatcher;

    private $decoratedDispatcher;

    protected function setUp()
    {
        $this->decoratedDispatcher = Phake::mock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->dispatcher = new DelayEventDispatcher($this->decoratedDispatcher, array('delayable.event'));
    }

    public function testDispatch()
    {
        $eventName = 'foo';
        $event = Phake::mock('Symfony\Component\EventDispatcher\Event');
        $this->dispatcher->dispatch($eventName, $event);
        Phake::verify($this->decoratedDispatcher)->dispatch($eventName, $event);

        $delayEvent = Phake::mock('Itkg\DelayEventBundle\Model\Event');
        $this->dispatcher->dispatch($eventName, $delayEvent);
        Phake::verify($this->decoratedDispatcher)->dispatch($eventName, $delayEvent);

        $eventName = 'delayable.event';
        $this->dispatcher->dispatch($eventName, $event);
        Phake::verify($this->decoratedDispatcher)->dispatch($eventName, $event);

        Phake::when($delayEvent)->isDelayed()->thenReturn(true);
        $this->dispatcher->dispatch($eventName, $delayEvent);
        Phake::verify($this->decoratedDispatcher)->dispatch(DelayableEvents::DELAY, Phake::capture($newEvent));
        $this->assertInstanceOf('Itkg\DelayEventBundle\Event\DelayableEvent', $newEvent);
        Phake::verify($delayEvent)->setOriginalName($eventName);
        /** @var \Itkg\DelayEventBundle\Event\DelayableEvent $newEvent */
        $this->assertEquals($delayEvent, $newEvent->getDelayedEvent());
    }
}
