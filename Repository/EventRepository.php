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
     * @param bool  $failed
     * @param array $eventTypeIncluded
     * @param array $eventTypeExcluded
     *
     * @return Event
     */
    public function findFirstTodoEvent($failed = false, array $eventTypeIncluded = [], array $eventTypeExcluded = [])
    {
        $qb = $this->createQueryBuilder();
        $qb->field('failed')->equals($failed);

        if (!empty($eventTypeIncluded)) {
            $qb->field('originalName')->in($eventTypeIncluded);
        }

        if (!empty($eventTypeExcluded)) {
            $qb->field('originalName')->notIn($eventTypeExcluded);
        }

        $qb->sort('createdAt', 'asc');

        return $qb->getQuery()->getSingleResult();
    }
}
