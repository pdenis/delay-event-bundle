<?php

namespace Itkg\DelayEventBundle\Handler;

/**
 * Interface LockHandlerInterface
 */
interface LockHandlerInterface
{
    /**
     * @param string $channel
     *
     * @return bool
     */
    public function isLocked($channel);

    /**
     * Create a lock
     *
     * @param string $channel
     *
     * @return
     */
    public function lock($channel);

    /**
     * Release a lock
     *
     * @param string $channel
     *
     * @return
     */
    public function release($channel);
}
