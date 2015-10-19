<?php

namespace Itkg\DelayEventBundle\DomainManager;

use Doctrine\Common\Persistence\ObjectManager;
use Itkg\DelayEventBundle\Model\Event;

/**
 * Class EventManager
 */
class EventManager implements EventManagerInterface
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * @param string          $class
     * @param ObjectManager   $om
     */
    public function __construct($class, ObjectManager $om)
    {
        $this->class = $class;
        $this->om = $om;
    }

    /**
     * @param Event $event
     */
    public function save(Event $event)
    {
        $this->om->persist($event);
        $this->om->flush($event);
    }

    /**
     * @param Event $event
     */
    public function delete(Event $event)
    {
        $this->om->remove($event);
        $this->om->flush($event);
    }
}
