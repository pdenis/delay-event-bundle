<?php

namespace Itkg\DelayEventBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Itkg\DelayEventBundle\Model\Lock;

/**
 * Class LockRepository
 */
class LockRepository extends DocumentRepository
{
    /**
     * @return Lock
     */
    public function findLock()
    {
        $qb = $this->createQueryBuilder();

        return $qb->getQuery()->getSingleResult();
    }
}
