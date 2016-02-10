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
     * {@inheritdoc}
     */
    public function isLocked($channel)
    {
        $lock = $this->lockManager->getLock($channel);

        return $lock->isCommandLocked();
    }

    /**
     * {@inheritdoc}
     */
    public function lock($channel)
    {
        $lock = $this->lockManager->getLock($channel);
        $lock->setCommandLocked(true);
        $this->lockManager->save($lock);
    }

    /**
     * {@inheritdoc}
     */
    public function release($channel)
    {
        $lock = $this->lockManager->getLock($channel);
        $lock->setCommandLocked(false);
        $this->lockManager->save($lock);
    }
}
