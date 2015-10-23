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
     * @param bool $failed
     *
     * @return Event
     */
    public function findFirstTodoEvent($failed = false)
    {
        $events = $this->findBy(array('failed' => $failed), array('createdAt' => 1), 1);

        return array_pop($events);
    }
}
