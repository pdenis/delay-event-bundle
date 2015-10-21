<?php

namespace Itkg\DelayEventBundle\DomainManager;

use Doctrine\Common\Persistence\ObjectManager;
use Itkg\DelayEventBundle\Model\Lock;
use Itkg\DelayEventBundle\Repository\LockRepository;

/**
 * Class LockManager
 */
class LockManager implements LockManagerInterface
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
     * @var LockRepository
     */
    protected $lockRepository;
    /**
     * @param string          $class
     * @param ObjectManager   $om
     */
    public function __construct($class, ObjectManager $om, LockRepository $lockRepository)
    {
        $this->class = $class;
        $this->om = $om;
        $this->lockRepository = $lockRepository;
    }

    /**
     * @param Lock $Lock
     */
    public function save(Lock $Lock)
    {
        $this->om->persist($Lock);
        $this->om->flush($Lock);
    }

    /**
     * @param Lock $Lock
     */
    public function delete(Lock $Lock)
    {
        $this->om->remove($Lock);
        $this->om->flush($Lock);
    }

    /**
     * @return Lock
     */
    public function createNew()
    {
        $class = $this->class;

        return new $class;
    }

    /**
     * @return Lock
     */
    public function getLock()
    {
        $lock = $this->lockRepository->findLock();

        if (!$lock) {
            $lock = $this->createNew();
        }

        return $lock;
    }
}
