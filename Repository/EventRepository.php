<?php

namespace Itkg\DelayEventBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Itkg\DelayEventBundle\Model\Event;

/**
 * Class EventRepository
 */
class EventRepository extends DocumentRepository
{
    /**
     * @return Event
     */
    public function findFirstTodoEvent()
    {
        $events = $this->findBy(array(), array('createdAt' => 1), 1);

        return array_pop($events);
    }
}
