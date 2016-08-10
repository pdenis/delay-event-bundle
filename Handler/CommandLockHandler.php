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
        $this->setLockStatusForChannel($channel, true);
    }

    /**
     * {@inheritdoc}
     */
    public function release($channel)
    {
        $this->setLockStatusForChannel($channel, false);
    }

    /**
     * @param string $channel
     * @param bool   $locked
     */
    private function setLockStatusForChannel($channel, $locked)
    {
        $lock = $this->lockManager->getLock($channel);
        $lock->setCommandLocked($locked);
        $this->lockManager->save($lock);
    }
}
