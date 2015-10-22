<?php

namespace Itkg\DelayEventBundle\Handler;

/**
 * Interface LockHandlerInterface
 */
interface LockHandlerInterface
{
    /**
     * @return boolean
     */
    public function isLocked();

    /**
     * Create a lock
     */
    public function lock();

    /**
     * Release a lock
     */
    public function release();
}
