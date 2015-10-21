<?php

namespace Itkg\DelayEventBundle\Handler;

use Itkg\DelayEventBundle\DomainManager\LockManagerInterface;

/**
 * Class CommandLockHandler
 */
class CommandLockHandler implements LockHandlerInterface
{
    /**
     * @var LockManagerInterface
     */
    private $lockManager;

    /**
     * @param LockManagerInterface $lockManager
     */
    public function __construct(LockManagerInterface $lockManager)
    {
        $this->lockManager = $lockManager;
    }

    /**
     * @return boolean
     */
    public function isLocked()
    {
        $lock = $this->lockManager->getLock();

        return $lock->isCommandLocked();
    }

    /**
     * Create a lock
     */
    public function lock()
    {
        $lock = $this->lockManager->getLock();
        $lock->setCommandLocked(true);
        $this->lockManager->save($lock);
    }

    /**
     * Release a lock
     */
    public function release()
    {
        $lock = $this->lockManager->getLock();
        $lock->setCommandLocked(false);
        $this->lockManager->save($lock);
    }
}
